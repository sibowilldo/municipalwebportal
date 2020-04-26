<?php

namespace App\Http\Controllers;

use App\StateColor;
use App\System;
use App\Type;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\TypesFormRequest;

class TypeController extends Controller
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
        $types = Type::all();
        return view('backend.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $state_colors = StateColor::all();
        return view('backend.types.create', compact('categories', 'state_colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TypesFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypesFormRequest $request)
    {
        if(Type::where('name', $request->name)->first()){
            flash("<strong>Error!</strong> A type with a same name already exists.")->error();
            return back();
        }
        $request['is_active'] = $request->is_active ? true : false;
        $type = Type::create($request->only(['name', 'description', 'is_active', 'state_color_id']));
        $type->categories()->attach($request->categories);

        flash($type->name . ' Type <strong>saved</strong> successfully')->success();
        return redirect()->route('types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Type $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('backend.types.show', compact('type'));
    }

    public function jsonShowByCategory(Category $category)
    {
        $categories = $category->types()->pluck('name', 'id');

        return response()->json([
           'message'=> 'OK',
           'data' => $categories
        ], 200);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = Type::with('categories')->findOrFail($id);
        $categories = Category::pluck('name', 'id');
        $state_colors = StateColor::all();

        return view('backend.types.edit', compact('categories', 'type', 'state_colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TypesFormRequest $request
     * @param Type $type
     * @return \Illuminate\Http\Response
     */
    public function update(TypesFormRequest $request, Type $type)
    {
        $request['is_active'] = $request->is_active ? true : false;
        $type->update($request->only(['name', 'description', 'is_active', 'state_color_id']));
        $type->categories()->sync($request->categories);

        flash($type->name . ' <strong>updated</strong> successfully')->success();
        return redirect()->route('types.show', $type->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Type $type
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Type $type)
    {
        if(count($type->categories)){

            return response()->json([
                "message"=> "Cannot delete $type->name type because it is associated with 1 or more categories.",
                "url" => route('types.show', $type->id)
            ], 500);
        }
        $type->delete();

        return response()->json([
            "message"=> $type->name . ' was deleted successfully',
            "url" => route('types.index')
        ], 200);
    }
}
