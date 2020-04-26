<?php

namespace App\Http\Controllers;

use App\Category;
use App\Department;
use App\District;
use App\Http\Requests\DepartmentFormRequest;
use App\Status;
use Spatie\Permission\Models\Role;

class DepartmentController extends Controller
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
        $statuses = Status::all()->pluck('name', 'name');
        $categories = Category::all()->pluck('name', 'name');
        $departments=Department::all();
        return view('backend.departments.index', compact('statuses', 'categories', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $statuses = Status::all()->pluck('name', 'id');
        $districts = District::all()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');
        count($districts)>0?:flash()->overlay('Please add at least 1 district before attempting to add a department.', '0 Districts Found')->warning();
        return view('backend.departments.create', compact('statuses', 'districts', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentFormRequest $request)
    {
        $department = Department::create($request->all());
        flash($department->name . ' added successfully')->success();
        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Department $department)
    {
        $statuses = Status::pluck('name', 'name');
        $roles = Role::all();
        $users = $department->users()->get();
        return view('backend.departments.show', compact('department', 'statuses', 'roles', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Department $department)
    {
        $statuses = Status::all()->pluck('name', 'id');
        $districts = District::all()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');
        return view('backend.departments.edit', compact('department', 'statuses', 'districts', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentFormRequest $request
     * @param Department $department
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DepartmentFormRequest $request, Department $department)
    {
        $department->update($request->all());

        $department->save();

        flash($department->name . ' added successfully')->success();
        return redirect()->route('departments.show', $department->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json([
            "message"=> $department->name . ' was deleted successfully',
            "url" => route('departments.index')
        ], 200);
    }
}
