<?php

namespace App\Http\Controllers;


use App\Assignment;
use App\Incident;
use App\IncidentHistory;
use App\Status;
use App\User;
use Carbon\Carbon;
use Auth;
use EloquentBuilder;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Validator;
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
     * Assign Engineer to Incident.
     *
     * @param  \App\Incident  $incident
     * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function assign(Incident $incident, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instructions' => 'required|string|max:255',
            'assigned_id' => 'required',
            ],
            [
               'instructions.required' => 'The Instructions Field is required.',
               'assigned_id.required' => 'Please select an Engineer, Repairman or Specialist from the list.',
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $engineer = User::findOrFail($request->assigned_id);

        $assigner = Auth::user();
        $status = Status::where('name', 'Assigned')->first();

        //Incident to Assignments table
        $assignment = new Assignment();

        $assignment->user_id = $engineer->id;
        $assignment->assigner_id = $assigner->id;
        $assignment->incident_id = $incident->id;
        $assignment->instructions = $request->instructions;
        $assignment->executed_at = Carbon::now();
        $assignment->due_at = Carbon::now()->addHours(2); //ToDo: time to be determined by settings

        $assignment->saveOrFail();

        // update user status
        $engineer->status_is = $status->name;
        $engineer->saveOrFail();

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

        flash($engineer->fullname.' was assigned.')->success();

        return redirect()->action('HomeController@index');
    }
}
