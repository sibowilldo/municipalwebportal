<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list roles');
        $this->middleware('permission:create role', ['only' => ['store']]);
        $this->middleware('permission:edit role', ['only' => ['update']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $roles = Role::orderBy('id','DESC')->paginate(5);

        return response()->json([
            $roles
        ]);
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
        //
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);


        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return response()->json(['message' => 'Success', 'data' => $role]) ;
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

        $role = Role::findById($id);

        return response()->json(['message' => 'Success', 'data' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return response()->json(['message' => 'success', 'data' => $role]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=Auth::user();
        $role = Role::findById($id);

        if($user->hasRole($role)){
            return response()->json(['message' => 'error', 'data' => 'Cannot delete role assigned to you.']);
        }
        $role->delete();

        return response()->json(['message' => 'success', 'data' => $role->name. ' was removed.']);
    }

    /**
     * Assign Role to User
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\\Response
     */
    public function assign(Request $request, User $user)
    {
        $user->syncRoles($request->roles);

        return response()->json([
            "message" => "Success"
        ]);
    }
}
