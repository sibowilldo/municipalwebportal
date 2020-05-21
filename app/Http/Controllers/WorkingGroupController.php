<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Http\Requests\WorkingGroupFormRequest;
use App\Incident;
use App\IncidentHistory;
use App\Status;
use App\User;
use App\WorkingGroup;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WorkingGroupController extends Controller
{
    private $maxSelection = 5;

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $working_groups = WorkingGroup::all();

        return view('backend.working-groups.index', compact('working_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $incident = null;
        if (request()->payload) {
            $incident = Incident::whereUuid(request()->payload)->first();
        }
        $leaders = User::role(['engineer', 'specialist'])->get();
        $statuses = Status::where('model_type', 'App\WorkingGroup')->get();
        return view('backend.working-groups.create', compact('leaders', 'incident', 'statuses'));
    }


    /**
     * @param Incident $incident
     * @param WorkingGroupFormRequest $request
     * @param WorkingGroup $workingGroup
     * @throws \Throwable
     */
    public function assign_group(Incident $incident, WorkingGroupFormRequest $request, WorkingGroup $workingGroup)
    {
        $assigner = Auth::user();
        $date_now = Carbon::now();
        $status = Status::where(['name'=> 'Assigned', 'model_type'=>'App\WorkingGroup'])->firstOrFail();

        $assignable = $workingGroup;
        $assignable_name = $assignable->name;

        //Incident to Assignments table
        $assignment = new Assignment([
            'incident_id' => $incident->id,
            'instructions' => $request->instructions,
            'assigner_id' => $assigner->id
        ]);

        $assignable->assignments()->save($assignment);
        // update user status
        $assignable->status_id = $status->id;
        $assignable->saveOrFail();


        // update incident status
        $incident->status_id = $status->id;
        $incident->saveOrFail();

        $current_status = $incident->histories()->latest('id')->first();

        // Create Incident History
        $incident_history = IncidentHistory::create([
            'incident_id' => $incident->id,
            'previous_status' => $current_status ? $current_status->status_id : $incident->status_id,
            'status_id' => $incident->status_id,
            'user_id' => $assigner->id,
            'account_number' => '',
            'update_reason' => "[Assigned {$date_now}] $assignable_name was assigned. Incident status changed to ASSIGNED"]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param WorkingGroupFormRequest $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function store(WorkingGroupFormRequest $request)
    {
        $leader = User::whereUuid($request->leader)->firstOrFail();
        $request['is_active'] = $request->is_active === 'on';


        DB::beginTransaction();
        $working_group = WorkingGroup::create($request->all());

        //Attach to pivot table
        $leader->working_groups()->attach($working_group, ['is_leader' => true, 'instructions' => '', 'assigner_id' => Auth::id()]);

        // Check if there is an incident passed through, and assign the newly created working group to that incident
        if(request()->incident_uuid){
            $incident = Incident::whereUuid(request()->incident_uuid)->first();
            if($incident){
                $this->assign_group($incident, $request, $working_group);
                $msg = "Working Group created and Assigned to Incident.";
            }
        }
        DB::commit();
        //Flash message and return response
        flash($msg ?? 'Working Group created successfully')->success();
        return response()->redirectToRoute('working-groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param WorkingGroup $working_group
     * @return View
     */
    public function show(WorkingGroup $working_group)
    {
        return view('backend.working-groups.show', compact('working_group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WorkingGroup $working_group )
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(WorkingGroup $working_group)
    {
        $leaders = User::all();
        $current_leader = $working_group->users()->where('is_leader', true)->first() ?: null;
        $group_engineers = $working_group->users()->where('is_leader', false)->get() ?: null;
        $statuses = Status::where('model_type', 'App\WorkingGroup')->get();
        $name = $working_group->name;
        return view('backend.working-groups.edit', compact('working_group', 'leaders', 'current_leader', 'name', 'statuses', 'group_engineers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param WorkingGroup $working_group
     * @return RedirectResponse
     */
    public function update(Request $request, WorkingGroup $working_group)
    {
        Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('working_groups')->ignore($working_group->id),
            ],
        ]);
        $leader = User::whereUuid($request->leader)->firstOrFail();
        $assigned_engineers = $request->assigned_engineers ?? [];
        //Merge engineers with leader
        array_push($assigned_engineers, $leader->id);

        $merged = [];
        foreach ($assigned_engineers as $engineer){
            $merged[$engineer] = ['assigner_id' => Auth::id(), 'is_leader' => $leader->id===$engineer];
        }

        //sync all engineers
        if (count($merged)){
            $sync_response = $working_group->users()->where('is_leader', false)->sync($merged);
        }

        $request['is_active'] = $request->is_active === 'on';
        $working_group->update($request->all());
        $working_group->save();

        flash('Details updated successfully')->success();
        return response()->redirectToRoute('working-groups.show', $working_group->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WorkingGroup $working_group
     * @return JsonResponse
     * @throws null
     */
    public function destroy(WorkingGroup $working_group)
    {
        try {
            $working_group->users()->detach();
            $working_group->delete();
        } catch (QueryException $exception) {
            return response()->json([
                "message" => 'Could not complete request. Please contact support.',
                "url" => redirect()->back()
            ], 500);
        }

        return response()->json([
            "message" => $working_group->name . ' was deleted successfully',
            "url" => route('working-groups.index')
        ], 200);
    }

    /**
     * Get: /working-group/{working_group}/engineers/list
     * Return a list of AVAILABLE engineers
     *
     * @param WorkingGroup $working_group
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function listEngineers(WorkingGroup $working_group, Request $request)
    {
        $leader = $working_group->users()->where('is_leader', true)->first();
        $selected = $working_group->users()->where('is_leader', false)->pluck('uuid')->toArray();//pluck('id')->toArray();

        $limit = $this->maxSelection;

        $statuses = Status::where('model_type', 'App\User')->whereNotIn('name', ['In Progress', 'Trashed', 'Review'])->pluck('id')->toArray();
        $engineers = User::role('Engineer')
            ->whereIn('status_id', $statuses)
            ->with('roles')
            ->get();

        return view("backend.working-groups.list", compact('working_group', 'engineers', 'leader', 'limit', 'selected'));
    }

    /**
     * POST: /working-group/{working_group}/engineers/assign
     * Assign the engineers to group
     *
     * @param WorkingGroup $working_group
     * @param Request $request
     * @return RedirectResponse
     */
    public function assignEngineers(WorkingGroup $working_group, Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'engineers' => 'required',
                'instructions' => 'required|string'],
            [
                'engineers.required' => 'Please select at least 1 name from the list below.'
            ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $leader = $working_group->users()->where('is_leader', true)->first();
        $engineers = $request->engineers;

        array_push($engineers, $leader->uuid);
        $status = Status::where('name', 'assigned')->firstOrFail();
        $syncEngineers = [];
        foreach ($engineers as $engineerUuid) {
            //assign engineer to working group
            $engineer = User::whereUuid($engineerUuid)->firstOrFail();
            $syncEngineers[$engineer->id] = ['is_leader' => $leader->id===$engineer->id, 'instructions' => $request->instructions, 'assigner_id' => Auth::id()];
            //set status to Assigned
            $engineer->status_id = $status->id;
            $engineer->save();
            //Todo: Notify engineer
        }

        $working_group->users()->where('is_leader', false)->sync($syncEngineers);

        $count = count($request->engineers);
        flash("$count engineers were assigned successfully", "success");
        return response()->redirectToRoute('working-groups.show', $working_group->id);
    }
}
