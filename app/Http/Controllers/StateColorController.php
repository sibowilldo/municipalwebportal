<?php

namespace App\Http\Controllers;

use App\StateColor;
use Illuminate\Http\Request;

class StateColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $state_colors = StateColor::all();
        return view('backend.state_colors.index', compact('state_colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.state_colors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $state_color = StateColor::create($request->only('name', 'css_class', 'css_color', 'css_font_color'));
        flash(ucfirst($state_color->name) . ' created successfully')->success();
        return redirect()->action('StateColorController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param StateColor $state_color
     * @return \Illuminate\Http\Response
     */
    public function show(StateColor $state_color)
    {
        return view('backend.state_colors.show', compact('state_color'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param StateColor $state_color
     * @return \Illuminate\Http\Response
     */
    public function edit(StateColor $state_color)
    {
        return view('backend.state_colors.edit', compact('state_color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param StateColor $state_color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StateColor $state_color)
    {
        $state_color->update($request->only('name', 'css_class', 'css_color', 'css_font_color'));
        flash(ucfirst($state_color->name) . ' updated successfully')->success();
        return redirect()->action('StateColorController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StateColor $stateColor
     * @return void
     */
    public function destroy(StateColor $stateColor)
    {
        $stateColor->delete();

        return response()->json([
            "message"=> $stateColor->name . ' was deleted successfully',
            "url" => route('state-colors.index')
        ], 200);
    }
}
