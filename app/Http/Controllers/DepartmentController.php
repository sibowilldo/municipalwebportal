<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

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
//        dd(Department::all());
        return view('backend.departments.index')->with('departments', Department::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.departments.create')->with('statuses', Department::$statuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'district' => 'required|string',
            'description' => 'required|string',
            'contact_number' => 'required|string',
            'email' => 'required|email|string',
            'alt_contact_number' => 'required|string',
            'address' => 'required',
        ]);

        $department = Department::create($request->all());

        flash($department->name . ' added successfully')->success();
        return redirect()->route('departments.index');
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
        $department = Department::findorFail($id);
        return view('backend.departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::findorFail($id);
        $statuses = Department::$statuses;
        return view('backend.departments.edit', compact('department', 'statuses'));
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
        $department = Department::findorFail($id);
        $department->update($request->all());

        $department->save();

        flash($department->name . ' added successfully')->success();
        return redirect()->route('departments.show', $department->id);
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
