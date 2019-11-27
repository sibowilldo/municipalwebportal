<?php

namespace App\Http\Controllers\Api;

use App\Assignment;
use App\Http\Resources\AssignmentResource;
use App\IncidentHistory;
use App\Status;
use Auth;
use App\Incident;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssignmentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the Assignments for logged user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $assignments = Auth::user()->assignments;
        return AssignmentResource::collection($assignments);
    }


    /**
     * Display the specified resource.
     *
     * @param Assignment $assignment
     * @return AssignmentResource
     */
    public function show(Assignment $assignment)
    {
        return new AssignmentResource($assignment);
    }

    /**
     * @param Assignment $assignment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function accept(Assignment $assignment)
    {
        //if assignment already accepted return the assignment resource
        if ($assignment->executed_at){
            return response()->json([
                'message' =>"This incident has already been accepted by an engineer.",
                'data'    => new AssignmentResource($assignment)], 200);
        }

        $status = Status::where('name', 'In Progress')->firstOrFail();
        $user = $assignment->user;
        $incident = $assignment->incident;
        $date_now = Carbon::now();
        //Update Assignment Executed and Due time
        //ToDo: time to be determined by settings
        $assignment->update(['instructions' => "[Declined {$date_now}] {$user->fullname} has accepted the request \n{$assignment->instructions}",
                            'executed_at' => Carbon::now(),
                            'due_at' => Carbon::now()->addHours(2),
                            'declined_at' => null,
                            'completed_at' => null]);


        $date_now = Carbon::now();
        //Add Incident History Entry
        $incident_history= IncidentHistory::create([
                'incident_id'       => $incident->id,
                'user_id'           => $user->id,
                'previous_status'   => $incident->status_id,
                'status_id'         => $status->id,
                'account_number'    => '',
                'update_reason'     =>"[Accepted {$date_now}] {$user->fullname} has accepted the request."
        ]);
        //Update incident status
        $incident->update(['status_id' => $status->id]);

        //ToDo: Notify user

        return response()->json([
            'message' =>"$user->fullname has accepted the request.",
            'data'    => new AssignmentResource($assignment)], 200);
    }

    /**
     * @param Request $request
     * @param Assignment $assignment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function decline(Request $request, Assignment $assignment)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);
        $user = Auth::user();
        $date_now = Carbon::now();

        $assignment->udpate(['instructions' => "[Declined {$date_now}] {$user->fullname} has declined the request with reason: 
                                                {$request->reason} \n{$assignment->instructions}",
                            'declined_at' => Carbon::now(),
                            'executed_at' => null,
                            'completed_at' => null,
                            'due_at' => null,
                            'is_active' => false
                            ]);

        $reason = $request->reason;
        $status = Status::where('name', 'Review')->firstOrFail();

        //Add Incident History Entry
        $incident_history= IncidentHistory::create([
            'incident_id'   => $assignment->incident->id,
            'user_id'       => $user->id,
            'previous_id'   => $assignment->incident->status_id,
            'status_id'     => $status->id,
            'update_reason' => "$user->fullname has declined the request: $request->reason"
        ]);

        $assignment->incident()->update(['status_id' => $status->id]);

        return response()->json([
            'message' => "$user->fullname has declined the request: $request->reason",
            'data'    => new AssignmentResource($assignment)], 200);
    }

    /**
     * @param Request $request
     * @param Assignment $assignment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function escalate(Request $request, Assignment $assignment)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);

        $reason = $request->reason;
        $status = Status::where('name', 'Escalated')->firstOrFail();

        $user = $assignment->user;
        $incident = $assignment->incident;
        //Update Assignment Executed and Due time
        //ToDo: time to be determined by settings
        $assignment->update(['due_at' => Carbon::now()->addHours(2)]);

        //Add Incident History Entry
        $incident_history= IncidentHistory::create([
            'incident_id'   => $incident->id,
            'user_id'       => $user->id,
            'previous_id'   => $incident->status_id,
            'status_id'     => $status->id,
            'update_reason' =>  $user->fullname .' has accepted the request.'
        ]);

        //Update incident status
        $incident->update(['status_id' => $status->id]);
        //ToDo: Notify user
        return response()->json([
            'message' => $user->fullname .' has accepted the request.',
            'data'    => new AssignmentResource($assignment)], 200);
    }
}
