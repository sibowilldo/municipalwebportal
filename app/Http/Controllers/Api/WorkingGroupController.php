<?php

namespace App\Http\Controllers\Api;

use App\Assignment;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkingGroupResource;
use App\Incident;
use App\IncidentHistory;
use App\Status;
use App\User;
use App\WorkingGroup;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class WorkingGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection :collection
     */
    public function index()
    {
        $working_groups = WorkingGroup::all();

        return WorkingGroupResource::collection($working_groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $leader = User::whereUuid($request->leader)->firstOrFail();
        $group = WorkingGroup::create($request->all());

        //Attach to pivot table
        $leader->working_groups()->attach($group, ['is_leader' => true, 'instructions' => '', 'assigner_id' => Auth::id()]);

        // Check if there is an incident passed through, and assign the newly created working group to that incident
        if (request()->incident_uuid) {
            $incident = Incident::whereUuid(request()->incident_uuid)->firstOrFail();
            if ($incident) {
                $date_now = Carbon::now();
                $status = Status::where('name', 'Assigned')->firstOrFail();

                $assignable = $group;

                //Incident to Assignments table
                $assignment = new Assignment([
                    'incident_id' => $incident->id,
                    'instructions' => $request->instructions,
                    'assigner_id' => Auth::id()
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
                    'user_id' => Auth::id(),
                    'account_number' => '',
                    'update_reason' => "[Assigned {$date_now}] $assignable->name was assigned. Incident status changed to ASSIGNED"]);
                $msg = "Working Group created and Assigned to Incident.";
            }
        }

        return response()->json(['message' => $msg ?? 'Working Group created successfully', 'data' => new WorkingGroupResource($group)]);
    }

    /**
     * Display the specified resource.
     *
     * @param WorkingGroup $workingGroup
     * @return WorkingGroupResource
     */
    public function show(WorkingGroup $workingGroup)
    {
        return new WorkingGroupResource($workingGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $group = WorkingGroup::findOrFail($id);
        $assigned_engineers = $request->assigned_engineers ?? [];
        $leader = User::whereUuid($request->leader)->firstOrFail();
        //Merge engineers with leader
        array_push($assigned_engineers, $leader->id);

        $merged = [];
        foreach ($assigned_engineers as $engineer) {
            $merged[$engineer] = ['assigner_id' => Auth::id(), 'is_leader' => $leader->id === $engineer];
        }

        //sync all engineers
        if (count($merged)) {
            $sync_response = $group->users()->where('is_leader', false)->sync($merged);
        }

        $group->update($request->all());
        $group->save();

        return response()->json(['message' => $msg ?? 'Working Group updated successfully', 'data' => new WorkingGroupResource($group)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function engineers(WorkingGroup $working_group, Request $request)
    {
        $status = Status::where('name', 'assigned')->firstOrFail();
        foreach ($request->engineers as $uuid) {
            //assign engineer to working group
            $engineer = User::whereUuid($uuid)->firstOrFail();
            $engineer->working_groups()->attach($working_group, ['is_leader' => false, 'instructions' => $request->instructions, 'assigner_id' => Auth::id()]);
            //set status to Assigned
            $engineer->status_id = $status->id;
            $engineer->save();
            //Notify engineer
        }

        return response()->json([
            'message' => count($request->engineers) . " Engineers were assigned successfully",
            'data' => new WorkingGroupResource($working_group)]);
    }
}
