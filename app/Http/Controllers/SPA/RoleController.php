<?php

namespace App\Http\Controllers\SPA;

use App\Http\Resources\RoleResource;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $guards = $roles->unique('guard_name')->pluck('guard_name');
        return  response()->json(['roles' => RoleResource::collection($roles), 'guards' => $guards], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //Validate name and permissions field
        $this->validate($request, [
                'name'=>'required|unique:roles|max:20',
                'permissions' =>'required',
            ]
        );

        $role = Role::first();
        return response()->json([
            'message'=>"Role $role->name added successfully.",
            'role'=>new RoleResource($role),
            'permissions' => $role->permissions], Response::HTTP_CREATED);

        $name = strtolower($request['name']);
        $role = new Role();

        $role->name = $name;
        $role->guard_name = $request['guard'];

        $permissions = $request['permissions'];

        $role->save();

        $role = Role::where('name', '=', $name)->first();

        $role->syncPermissions($permissions);

        return response()->json([
            'message'=>"Role $role->name added successfully.",
            'role'=>$role,
            'permissions' => $role->permissions], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
}
