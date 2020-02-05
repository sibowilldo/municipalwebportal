<?php

namespace App\Http\Controllers;

use App\Incident;
use App\Status;
use App\User;
use App\WorkingGroup;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WorkingGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $working_groups = WorkingGroup::all();

        return view('backend.working-groups.index', compact('working_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $incident = null;
        if (request()->payload) {
            $incident = Incident::whereUuid(request()->payload)->first();
        }
        $leaders = User::all();
        $statuses = Status::all();
        return view('backend.working-groups.create', compact('leaders', 'incident', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $leader = User::whereUuid($request->leader)->firstOrFail();
        $request['is_active'] = $request->is_active === 'on' ? true : false;
        $working_group = WorkingGroup::create($request->all());

        //Attach to pivot table
        $leader->working_groups()->attach($working_group, ['is_leader' => true, 'instructions' => 'Coming Soon', 'assigner_id' => Auth::id()]);

        // Check if there is an incident passed through, and assign the newly created working group to that incident
//        if(request()->incident_id){
//            $incident = Incident::whereUuid(request()->incident_id)->first();
//        }

        //Flash message and return response
        flash('Working Group created successfully')->success();
        return response()->redirectToRoute('working-groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param WorkingGroup $working_group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(WorkingGroup $working_group)
    {
        return view('backend.working-groups.show', compact('working_group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WorkingGroup $working_group )
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(WorkingGroup $working_group)
    {
        $leaders = User::all();
        $current_leader = $working_group->users()->where('is_leader', true)->first() ?: null;
        $group_engineers = $working_group->users()->where('is_leader', false)->get() ?: null;
        $statuses = Status::all();
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
        $assigned_engineers = $request->assigned_engineers ?? [];
        $leader = User::whereUuid($request->leader)->firstOrFail();
        //Merge engineers with leader
        array_push($assigned_engineers, $leader->id);

        //sync all engineers
        $sync_response = $working_group->users()->where('is_leader', false)->sync($assigned_engineers ?: []);

        $request['is_active'] = $request->is_active === 'on' ? true : false;
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
        $statuses = Status::all();
        $engineers = User::role('Engineer')
            ->whereIn('status_id', $statuses->whereNotIn('name', ['In Progress', 'Trashed', 'Review'])
                ->pluck('id'))->whereNotIn('id', [$leader->id ?? null])
            ->with('roles')
            ->get();
        return view("backend.working-groups.list", compact('working_group', 'engineers', 'leader'));
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
        $selectedEngineers = explode(',', $request->selectedEngineers);
        $status = Status::where('name', 'assigned')->firstOrFail();
        foreach ($selectedEngineers as $engineerUuid) {
            //assign engineer to working group
            $engineer = User::whereUuid($engineerUuid)->firstOrFail();
            $engineer->working_groups()->attach($working_group, ['is_leader' => false, 'instructions' => $request->instructions, 'assigner_id' => Auth::id()]);
            //set status to Assigned
            $engineer->status_id = $status->id;
            $engineer->save();
            //Notify engineer
        }

        flash(count($selectedEngineers) . " engineers were assigned successfully", "success");
        return response()->redirectToRoute('working-groups.show', $working_group->id);
    }
}
