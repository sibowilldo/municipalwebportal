<?php

namespace App\Http\Controllers;

use App\Incident;
use App\User;
use App\WorkingGroup;
use Auth;
use Carbon\Carbon;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class WorkingGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $working_groups = WorkingGroup::all();

        return view('backend.working-groups.index', compact('working_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $incident=null;
        if(request()->payload){
            $incident = Incident::whereUuid(request()->payload)->first();
        }
        $leaders = User::all();

        return view('backend.working-groups.create', compact('leaders', 'incident'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $leader = User::findOrFail($request->leader);
        $request['is_active'] = $request->is_active === 'on' ? true:false;
        $working_group = WorkingGroup::create($request->all());

        //Attach to pivot table
        $leader->working_groups()->attach($working_group, ['is_leader' => true, 'instructions' => 'Coming Soon', 'assigner_id' => Auth::id()]);

        //Flash message and return response
        flash('Working Group created successfully')->success();
        return response()->redirectToRoute('working-groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  WorkingGroup $working_group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(WorkingGroup $working_group)
    {
        return view('backend.working-groups.show', compact('working_group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  WorkingGroup $working_group)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(WorkingGroup $working_group)
    {
        $leaders = User::all();
        $current_leader = null;
        $group_users = $working_group->users;
        foreach ($group_users as $user){
            if($user->pivot->is_leader){
                $current_leader = $user;
                break ;
            }
        }
        $name = $working_group->name;
        return view ('backend.working-groups.edit', compact('working_group', 'leaders', 'current_leader', 'name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  WorkingGroup $working_group
     * @return RedirectResponse
     */
    public function update(Request $request, WorkingGroup $working_group)
    {
        $request['is_active'] = $request->is_active === 'on' ? true:false;
        $working_group->update($request->all());
        $working_group->save();

        flash('Details updated successfully')->success();
        return response()->redirectToRoute('working-groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  WorkingGroup $working_group
     * @return JsonResponse
     * @throws null
     */
    public function destroy(WorkingGroup $working_group)
    {
        try{
            $working_group->delete();
        }catch (QueryException $exception){
            return response()->json([
                "message"=> 'Could not complete request. Please contact support.',
                "url" => redirect()->back()
            ], 500);
        }

        return response()->json([
            "message"=> $working_group->name . ' was deleted successfully',
            "url" => route('working-groups.index')
        ], 200);
    }

    public function assign(WorkingGroup $workingGroup, Incident $incident, Request $request)
    {

    }
}
