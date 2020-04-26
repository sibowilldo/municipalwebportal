<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Requests\DistrictFormRequest;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $districts = District::all();
        return view('backend.districts.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.districts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DistrictFormRequest $request)
    {
        $district = District::create($request->all());

        flash($district->name. ' district saved successfully')->success();

        return response()->redirectToRoute('districts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(District $district)
    {
        return view('backend.districts.show', compact('district'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(District $district)
    {
        return view('backend.districts.edit', compact('district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DistrictFormRequest $request
     * @param \App\District $district
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DistrictFormRequest $request, District $district)
    {
        $district->update($request->only(['name', 'email', 'contact_number']));
        flash($district->name . ' updated successfully')->success();

        return response()->redirectToRoute('districts.show', $district->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\District $district
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(District $district)
    {
        $district->delete();

        return response()->json([
            "message"=> $district->name . ' was deleted successfully',
            "url" => route('districts.index')
        ], 200);
    }
}
