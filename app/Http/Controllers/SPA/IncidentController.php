<?php

namespace App\Http\Controllers\SPA;

use App\Events\IncidentHistoryEntryEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\IncidentFormRequest;
use App\Http\Resources\IncidentSpaResource as IncidentResource;
use App\Incident;
use App\Status;
use App\User;
use Auth;
use Carbon\Carbon;
use EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $incidents = EloquentBuilder::to(Incident::class, request()->only(['sort', 'status', 'category', 'search']));
        if(request('has_range')){
            $incidents = $incidents->whereBetween('created_at', [request()->start_date, request()->end_date]);
        }else{
            $incidents = $incidents->where('created_at', '<', Carbon::now());
        }

        return IncidentResource::collection($incidents->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IncidentFormRequest $request
     * @return IncidentResource
     * @throws \Throwable
     */
    public function store(IncidentFormRequest $request)
    {
        $user = Auth::user();
        if (!$request->is_public){
            $request['email']=$request->email??config('app.noreply_email'); //if the email is not provided by client, use the default email address
            $validator = Validator::make($request->only(['firstname', 'lastname', 'email', 'contactnumber']),
                [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'email',
                    'contactnumber' => 'required'
                ],
                [
                    'firstname.required' => 'The First Name field is required.',
                    'lastname.required' => 'The Last Name field is required',
                    'contactnumber.required' => 'The Contact Number field is required, for further communication purposes and updates.',
                ]);
            if ($validator->fails()) {
                return response()->json(['message'=>'', 'errors' => $validator->messages()], 422);
            }
            $status = Status::where('name', 'active')->firstOrFail(); //ToDo set to unverified later
            $user = new User([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'contactnumber' => $request->contactnumber,
                    'activation_token' => '', //str_random(60), // ToDo set to str_random(60) later
                    'email_verified_at' => Carbon::now(), //null, ToDo: Set to Null
                    'email' => $request->email,
                    'password' => bcrypt(str_random(20)),
                    'status_id' => $status->id]);
            $user->saveOrFail();

            $role = Role::findByName('user', 'api');
            $user->assignRole($role); //assign role(s) to user

            if($user->email !== config('app.noreply_email')){
                //ToDo: send email with password reset instructions
            }
            //Todo: If incident is public or user opted to be notified about the incident
        }
        $incident = Incident::create($request->only(
                                ["reference", "name", "description", "location_description", "longitude", "latitude",
                                    "category_id", "type_id", "status_id", "suburb_id"]));

        $user->incidents()->attach($incident, ['has_location' => true, 'has_attachment' => false, 'source_id' => 0 ]);
        return new IncidentResource($incident);
    }

    /**
     * Display the specified resource.
     *
     * @param Incident $incident
     * @return IncidentResource
     */
    public function show(Incident $incident)
    {
        return new IncidentResource($incident);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Incident $incident
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Incident $incident, Request $request)
    {
        $this->authorize('delete', $incident);

        //Get status
        $status = Status::where('name', 'deleted')->firstOrFail();

        //Add Incident to IncidentHistory table
        event(new IncidentHistoryEntryEvent(
            $incident->status, $incident,
            Auth::user(),
            "Status changed from " . $incident->status->name . " to $status->name" . ". REASON: $request->delete_reason"));

        $incident->update(['status_id', $status->id]);
        $incident->delete();

        return response()->json(['message' => "$incident->name was sent to trash."], 200);
    }
}
