<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::all();
        return response()->json(['success' => $permissions]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return response()->json(['success' => $permissions]) ;
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
        $this->validate(
            $request,
            [
                'name' => 'required|max:40',
                'roles' => 'required'
            ]
        );

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;
        $permission->guard_name = 'api';

        $roles = $request['roles'];
        $permission->save();

        if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }


        return response()->json(['message' => 'success', 'data' => 'Permission `' . $permission->name . '` was created.'], 201);
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
        $permission = Permission::findOrFail($id);

        return response()->json(['message' => 'success', 'data' => $permission]);
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
        $permission = Permission::findOrFail($id);

        return response()->json(['message' => 'success', 'data' => $permission]);
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
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->save();

        return response()->json(['message' => 'success', 'data' => 'Permission was updated.']);
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
        $user = Auth::user();

        $permission = Permission::findOrFail($id);
        if($user->hasPermissionTo($permission)){
            return response()->json(['message' => 'error', 'data' => 'Cannot delete permission given to you. Request user with Administrator role to revoke permission']);
        }
        $permission->delete();

        return response()->json(['message' => 'success', 'data' => 'Permission removed.']);
    }
}
