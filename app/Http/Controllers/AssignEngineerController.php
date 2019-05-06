<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Incident;
use App\IncidentHistory;
use App\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class AssignEngineerController extends Controller
{

    public function __construct() {
        $this->middleware(['auth']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * List Available Engineers.
     *
     *
     * @param  \App\Incident  $incident
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Incident $incident)
    {
        $engineers = User::role('engineer')->get(); //todo: Add where Department is relative to incident

        return view('backend.engineers.list', compact('engineers', 'incident'));
    }

    /**
     * Assign Engineer to Incident.
     *
     * @param  \App\User  $user
     * @param  \App\Incident  $incident
     *
     * @return \Illuminate\Http\Response
     */
    public function assign(Incident $incident, Request $request)
    {
        $request['assigned_engineers'] = explode(',', $request->assigned_engineers);

        $engineers = User::whereIn('id', $request->assigned_engineers)->get();
        $engineer_count = count($engineers);

        //Avoid performing any further actions without assigning at least 1 person
        if($engineer_count < 1){
            flash()->warning('Please assign at least <strong>One</strong> Engineer');
            return back();
        }

        $assigner = Auth::user();
        $status = Status::where('name', 'Assigned')->first();

//        dd($request->all());

        //Incident to Assignments table
        foreach($engineers as $engineer){
            $assignment = new Assignment();

            $assignment->user_id = $engineer->id;
            $assignment->assigner_id = $assigner->id;
            $assignment->incident_id = $incident->id;
            $assignment->instructions = $request->instructions;
            $assignment->executed_at = Carbon::now();
            $assignment->due_at = Carbon::now()->addHours(2);

            $assignment->saveOrFail();

            // update user status
            $engineer->status_is = $status->name;
            $engineer->saveOrFail();
        }

        //Add Incident to IncidentHistory table
        $incident_history = new IncidentHistory();

        $incident_history->incident_id = $incident->id;
        $incident_history->previous_status = $incident->status_id;
        $incident_history->status_id = $status->id;
        $incident_history->account_number = '';
        $incident_history->update_reason = 'User Assigned to Fault';
        $incident_history->saveOrFail();

        // update incident status
        $incident->status_id = $status->id;
        $incident->saveOrFail();

        flash()->success( $engineer_count == 1 ? 'One engineer has been assigned' : $engineer_count. ' Engineers have been assigned');

        return redirect()->action('HomeController@index');
    }
}
