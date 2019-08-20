<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Category;
use App\Http\Requests\IncidentFormRequest;
use App\Http\Resources\Incident as IncidentResource;
use App\Incident;
use App\IncidentHistory;
use App\Status;
use App\Type;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Validator;

class IncidentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);//isAdmin middleware lets only users with a //specific permission permission to access these resources

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $incidents = Incident::with('users')->with('status')->get()->sortByDesc('created_at');
        $statues = Status::all('id', 'name');
        $categories = Category::all('id', 'name');

        return view('backend.incidents.index', compact('incidents', 'statues', 'categories'));
    }

    public function jsonIndex()
    {

        $incidents = Incident::get()->sortBy('created_at');

        if (!count($incidents)) {
            return response()->json([
                'data' => 'Nothing Found!',
                'message' => 'OK'
            ], 404);
        }
        return IncidentResource::collection($incidents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
//        dd($user->hasAnyRole(['administrator', 'super-administrator']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncidentFormRequest $request)
    {
        $this->authorize('create', Incident::class);

        $user = Auth::user();

        $incident = new Incident([
            'reference' => Carbon::now()->timestamp, //ToDo: Auto-Generate
            'name' => $request->name,
            'description' => $request->description,
            'location_description' => $request->location_description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'suburb_id' => $request->suburb_id,
            'type_id' => $request->type_id,
            'status_id' => $request->status_id

        ]);
        $incident->save();
        $user->incidents()->attach($incident, ['has_location' => true, 'has_attachment' => false, 'source_id' => 0]);
        flash($incident->name . ' <b>Logged</b> Successfully')->success();


        return redirect()->back(201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Incident $incident)
    {
        return view('backend.incidents.show')->with('incident', $incident);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Incident $incident
     * @return \Illuminate\Http\Response
     */
    public function edit(Incident $incident)
    {
        $this->authorize('update', $incident);
        $categories = Category::all('id', 'name');
        $types = Type::pluck('name', 'id');

        return view('backend.incidents.edit', compact('incident', 'categories', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(IncidentFormRequest $request, Incident $incident)
    {
        $this->authorize('update', $incident);
        $incident->update($request->only(['name', 'description', 'location_description', 'latitude', 'longitude', 'suburb_id', 'type_id', 'status_id']));

        flash($incident->name . ' <b>Updated</b> Successfully')->success();
        return redirect()->action('IncidentController@show', $incident);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incident $incident, Request $request)
    {
        $this->authorize('delete', $incident);


        //Get status
        $status = Status::where('name', 'deleted')->firstOrFail();

        //Add Incident to IncidentHistory table
        $this->update_incident_history($incident, $status, Auth::user(), $request->delete_reason);

        $incident->delete();
        flash($incident->name . ' was sent to trash.')->success();
        return response()->redirectToRoute('dashboard');
    }

    /**
     * List Available Engineers.
     *
     *
     * @param \App\Incident $incident
     *
     * @return \Illuminate\Http\Response
     */
    public function engineers(Incident $incident)
    {
        try {
            // Validate the value...
            $engineers = User::role('engineer')->get();//todo: Add where Department is relative to incident
            return view('backend.engineers.list', compact('engineers', 'incident'));
        } catch (RoleDoesNotExist $e) {
            report($e);
            abort(404, 'Oops! We could not find the role you requested for.');
        }
    }

    /**
     * List Available Specialist.
     *
     *
     * @param \App\Incident $incident
     *
     * @return \Illuminate\Http\Response
     */
    public function specialists(Incident $incident)
    {
        try {
            // Validate the value...
            $engineers = User::role('specialist')->get();//todo: Add where Department is relative to incident
            return view('backend.engineers.list', compact('engineers', 'incident'));
        } catch (RoleDoesNotExist $e) {
            report($e);
            abort(404, 'Oops! We could not find the role you requested for.');
        }
    }


    /**
     * Assign Engineer to Incident.
     *
     * @param \App\Incident $incident
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function assign(Incident $incident, Request $request)
    {
        $validator = Validator::make($request->all(),
            [
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
        $status = Status::where('name', 'Assigned')->firstOrFail();

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
        $engineer->status_id = $status->id;
        $engineer->saveOrFail();

        //Add Incident to IncidentHistory table
        $this->update_incident_history($incident, $status, Auth::user(), $engineer->fullname . ' was assigned.');

        // update incident status
        $incident->status_id = $status->id;
        $incident->saveOrFail();

        flash($engineer->fullname . ' was assigned.')->success();

        return redirect()->action('HomeController@index');
    }

    public function update_incident_history(Incident $incident, Status $status, User $user, $update_reason, $account_number='')
    {
        $incident_history = new IncidentHistory();

        $incident_history->incident_id = $incident->id;
        $incident_history->previous_status = $incident->status_id;
        $incident_history->status_id = $status->id;
        $incident_history->user_id = $user->id;
        $incident_history->account_number = $account_number;
        $incident_history->update_reason = $update_reason;
        $incident_history->saveOrFail();
    }
}
