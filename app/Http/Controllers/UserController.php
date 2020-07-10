<?php

namespace App\Http\Controllers;

use App\Department;
use App\Status;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Spatie\Permission\Models\Role;

//Importing laravel-permission models

//Enables us to output flash messaging
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:administrator|super-administrator']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()->with(['status:id,name,state_color_id', 'status.state_color', 'departments:name', 'roles:name'])->get();
        $statuses = $users->pluck(['status']);
        $roles = Role::all();
        return view('backend.users.index', compact('users', 'statuses', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::get();
        $statuses = Status::where('model_type', 'App\User')->pluck('name', 'id');
        return view('backend.users.create', compact('roles', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validate fields
        $request->validate(
            [
                'firstname'=>'required|max:120',
                'lastname'=>'required|max:120',
                'contactnumber'=>'required|max:20',
                'email'=>'required|email|unique:users',
                'roles' => 'required'
            ]
        );

        //Randomly generate a password and hash it immediately
        $request['password'] = bcrypt(Str::random(10));
        $request['activation_token'] = Str::random(25);

        $user = User::create($request->only('firstname', 'lastname', 'email', 'contactnumber', 'status_id', 'password', 'activation_token')); //Retrieving only the email and password data

        //Todo remove email verification bypass
        $user->email_verified_at = null;
        $user->save();

        //Todo: Notify user via email that user account created, must be verified and password changed!

        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        //Redirect to the users.index view and display message
        flash('User added and notified.')->success();

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        //if the logged in user is the same as the user being updated then, they must use the update profile page.
        if($user->id === Auth::id()){
            return response()->redirectToRoute('profile.edit', $user->uuid);
        }

        $roles = Role::pluck('name', 'id'); //Get all roles
        $departments = Department::pluck('name', 'id');
        $statuses = Status::whereIn('model_type', ['App\User'])->pluck('name', 'id');
        return view('backend.users.edit', compact('user', 'roles', 'statuses', 'departments')); //pass user roles and statuses data to view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User $user
     * @return Response
     */
    public function update(Request $request, $user)
    {
        //Validate name, email and password fields
        $request->validate(
            [
                'firstname'=>'required|max:120',
                'lastname'=>'required|max:120',
                'contactnumber'=>'required|max:20',
                'roles' => 'required'
            ]
        );

        $input = $request->only(['firstname', 'lastname', 'contactnumber', 'status_id']); //Retreive the name, email and password fields

        $roles = $request['roles']; //Retreive all roles
        $user->fill($input)->save();

        if($request->department_id){
            $user->departments()->sync([$request->department_id=>['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]]);
        }
        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove existing role associated to a user
        }

        flash('User successfully edited.')->success();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $user
     * @return Response
     */
    public function destroy($user)
    {
        $status = Status::where('name', 'trashed')->firstOrFail();
        //Find a user with a given id and delete
            $user->delete();
            $user->status_id = $status->id;
            $user->save();
            return response()->json([
                "message"=> $user->fullname . ' was deleted successfully',
                "url" => route('users.index')
            ], 200);
    }

    /**
     * Restores the specified resource from storage.
     *
     * @param   User $user
     * @return Response
     */
    public function restore(Request $request, User $user)
    {
        //Find a user with a given id and restore
            $user = User::withTrashed()->whereUuid($request->id)->first();
            $status = Status::where('name', 'active')->firstOrFail();
            $user->status_id = $status->id;
            $user->restore();
            return response()->json([
                "message"=> $user->fullname . ' was restored successfully',
                "url" => route('users.index')
            ], 200);
    }
}
