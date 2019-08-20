<?php

namespace App\Http\Controllers;

use App\Incident;
use App\User;
use Illuminate\Http\Request;

class AssignGroupController extends Controller
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
        $engineers = User::role(['engineer', 'specialist'])->get(); //todo: Add where Department is relative to incident

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * List Available Engineers.
     *
     *
     * @param  \App\Incident  $incident
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Incident $incident)
    {

    }

    /**
     * Assign Working Group to Incident.
     *
     * @param  \App\User  $user
     * @param  \App\Incident  $incident
     *
     * @return \Illuminate\Http\Response
     */
    public function assign(Request $request, Incident $incident)
    {
        //
    }
}
