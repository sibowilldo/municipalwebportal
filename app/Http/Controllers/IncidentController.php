<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Category;
use App\Events\IncidentHistoryEntryEvent;
use App\Http\Requests\IncidentFormRequest;
use App\Http\Resources\IncidentCollection;
use App\Incident;
use App\Status;
use App\Type;
use App\User;
use App\WorkingGroup;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @return Response
     */
    public function index()
    {

        $incidents = Incident::with('users', 'status')->orderByDesc('created_at')->paginate(12);
        $statuses = Status::whereIn('model_type', ['App\Incident', 'both'])->select('id', 'name');
        $categories = Category::all('id', 'name');
        return view('backend.incidents.index', compact('incidents', 'statuses', 'categories'));
    }

    public function jsonIndex(Request $request)
    {
        $incidents = Incident::take(-1);
        $total = count($incidents->get());
        $query = $incidents
            ->skip(((int)$request->pagination['page'] ?: 0) * ((int)$request->pagination['pages'] ?: 0))
            ->take($request->pagination['perpage'] ?: 10)
            ->orderBy($request->sort['field'] ?: 'name', $request->sort['sort'] ?: 'desc')
            ->get();

        if (!count($incidents->get())) {
            return response()->json([
                'data' => 'Nothing Found!',
                'message' => 'OK'
            ], 404);
        }

        return response()->json([
            'meta' => [
                'page' => $request->pagination['page'],
                'pages' => $request->pagination['pages'],
                'perpage' => $request->pagination['perpage'],
                'total' => $total,
                'sort' => 'asc',
                'field' => 'id'
            ],
            'data' => new IncidentCollection($query)
        ]);

//        return new IncidentCollection($incidents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.incidents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IncidentFormRequest $request
     * @return Response
     * @throws null
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
     * @param Incident $incident
     * @return Response
     */
    public function show(Incident $incident)
    {
        $histories = $incident->histories()->orderByDesc('created_at')->get();
        $assigned_to = $incident->assignments()->latest('created_at')->first() ?
            $incident->assignments()->latest('created_at')->first()->assignable : null;

        return view('backend.incidents.show', compact('incident', 'histories', 'assigned_to'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Incident $incident
     * @return Response
     * @throws null
     */
    public function edit(Incident $incident)
    {
        $this->authorize('update', $incident);
        $categories = Category::all('id', 'name');
//        $types = Type::pluck('name', 'id');
        $statuses = Status::where('model_type', 'App\Incident')
                    ->whereIn('name', ['active', 'Duplicate', 'in progress', 'escalated', 'completed', $incident->status->name])
                    ->select('id', 'name');

        return view('backend.incidents.edit', compact('incident', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param IncidentFormRequest $request
     * @param Incident $incident
     * @return Response
     * @throws null
     */
    public function update(IncidentFormRequest $request, Incident $incident)
    {
        $this->authorize('update', $incident);
        $message=null;
        $status = $incident->status;
        if($incident->status_id !== intval($request->status_id)) {
            $newStatus =  Status::where('id', $request->status_id)->first()->name;
            $message = "Status changed from $status->name to $newStatus";
        }
        $incident->update($request->only(['name', 'description', 'location_description', 'latitude', 'longitude', 'suburb_id', 'type_id', 'status_id']));

        //Add Incident to IncidentHistory table
        event(new IncidentHistoryEntryEvent(
            $status, $incident, Auth::user(), $message?:"Incident details updated."));

        flash($incident->name . ' <b>Updated</b> Successfully')->success();
        return response()->redirectToRoute('incidents.show', $incident->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Incident $incident
     * @param Request $request
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Incident $incident, Request $request)
    {
        $this->authorize('delete', $incident);

        //Get status
        $status = Status::where('name', 'review')->firstOrFail();

        //Add Incident to IncidentHistory table
        event(new IncidentHistoryEntryEvent(
            $incident->status, $incident,
            Auth::user(),
            "Status changed from " . $incident->status->name . " to $status->name" . ". REASON: $request->delete_reason"));

        $incident->update(['status_id', $status->id]);
        $incident->delete();

        flash("$incident->name incident was sent to trash.")->success();
        return response()->redirectToRoute('dashboard');
    }

    /**
     * GET: incidents/{incident}/engineers/
     * List Available Engineers.
     *
     *
     * @param $incident
     *
     * @return Response
     */
    public function engineers(Incident $incident)
    {
        try {
            // Validate the value...
            // whereNotIn = Engineer cannot assign him/herself
            $engineers = User::role('engineer')->whereNotIn('id', [Auth::user()->id])->get();//todo: Add where Department is relative to incident
            return view('backend.engineers.list', compact('engineers', 'incident'));
        } catch (RoleDoesNotExist $e) {
            report($e);
            abort(404, 'Oops! We could not find the list of users you requested for.');
        }
    }

    /**
     * GET: incidents/{incident}/specialists/
     * List Available Specialist.
     *
     *
     * @param Incident $incident
     *
     * @return Response
     */
    public function specialists(Incident $incident)
    {
        try {
            // Validate the value...
            // whereNotIn = Specialist cannot assign him/herself
            $engineers = User::role('specialist')->whereNotIn('id', [Auth::user()->id])->get();//todo: Add where Department is relative to incident
            return view('backend.engineers.list', compact('engineers', 'incident'));
        } catch (RoleDoesNotExist $e) {
            report($e);
            abort(404, 'Oops! We could not find the list of users you requested for.');
        }
    }

    /**
     * GET: incidents/{incident}/groups/
     * List Available Working Groups.
     *
     *
     * @param Incident $incident
     *
     * @return Response
     */
    public function groups(Incident $incident)
    {
        $assigned_group = $incident->assignments()->where('is_group', true)->latest('created_at')->first()?:null;
        $groups = WorkingGroup::get(); //todo: Add where Department is relative to incident
        return view('backend.incidents.groups', compact('groups', 'incident', 'assigned_group'));
    }

    /**
     * POST: incidents/{incident}/assign
     * Assign Engineer to Incident.
     *
     * @param Incident $incident
     * @param Request $request
     * @return RedirectResponse
     * @throws null
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

        $assigner = Auth::user();
        $status = Status::where('name', 'Assigned')->firstOrFail();
        $date_now = Carbon::now();

        //check request->is_group ? true: get group object;
        if ($request->is_group){
            $assignable = WorkingGroup::findOrfail($request->assigned_id);
            $assignable_name = $assignable->name;
        }else{// false: get user object
            $assignable = User::whereUuid($request->assigned_id)->firstOrFail();
            $assignable_name = $assignable->fullname;
        }

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

        //Add Incident to IncidentHistory table
        event(new IncidentHistoryEntryEvent(
            $incident->status, $incident,
            Auth::user(),
            "Status changed from " . $incident->status->name . " to $status->name"));

        // update incident status
        $incident->status_id = $status->id;
        $incident->saveOrFail();

        flash("$assignable_name was assigned.")->success();

        return redirect()->action('HomeController@index');
    }
}
