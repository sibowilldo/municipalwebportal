<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::withTrashed()->get();
        $statuses = User::$statuses;
        return view('backend.users.index', compact('users', 'statuses'));
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
        $statuses = User::$statuses;
        return view('backend.users.create', ['roles'=>$roles, 'statuses' => $statuses]);
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
        //Validate name, email and password fields
        $this->validate(
            $request,
            [
                'name'=>'required|max:120',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6|confirmed'
            ]
        );

            $user = User::create($request->only('email', 'name', 'password')); //Retrieving only the email and password data

            $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {

            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        //Redirect to the users.index view and display message
        flash('User successfully added.')->success();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles
        $statuses = User::$statuses; //Get all statuses

        return view('backend.users.edit', compact('user', 'roles', 'statuses')); //pass user roles and statuses data to view

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
        $user = User::findOrFail($id); //Get role specified by id
        //Validate name, email and password fields
        $this->validate(
            $request,
            [
                'firstname'=>'required|max:120',
                'lastname'=>'required|max:120',
                'contactnumber'=>'required|max:20',
                'email'=>'required|email|unique:users,email,'.$id,
                // 'password'=>'required|min:6|confirmed'
            ]
        );
        $input = $request->only(['firstname', 'lastname', 'contactnumber', 'status_is', 'email']); //Retreive the name, email and password fields

        $roles = $request['roles']; //Retreive all roles
        $user->fill($input)->save();

        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        flash('User successfully edited.')->success();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find a user with a given id and delete
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                "message"=> $user->fullname . ' was deleted successfully',
                "url" => route('users.index')
            ], 200);
    }

    /**
     * Restores the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        //Find a user with a given id and restore
            $user = User::withTrashed()->findOrFail($id);
            $user->restore();
            return response()->json([
                "message"=> $user->fullname . ' was restored successfully',
                "url" => route('users.index')
            ], 200);
    }
}
