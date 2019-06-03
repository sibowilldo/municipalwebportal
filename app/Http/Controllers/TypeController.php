<?php

namespace App\Http\Controllers;

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
        return view('backend.types.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TypesFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypesFormRequest $request)
    {
        $request['is_active'] = $request->is_active ? true : false;
        $type = Type::create($request->only(['name', 'description', 'is_active']));
        $type->categories()->attach($request->categories);

        flash($type->name . ' Type <strong>saved</strong> successfully')->success();
        return redirect()->route('types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = Type::findOrFail($id);
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

        return view('backend.types.edit', compact('categories', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypesFormRequest $request, Type $type)
    {
        $request['is_active'] = $request->is_active ? true : false;
        $type->update($request->only(['name', 'description', 'is_active']));
        $type->categories()->sync($request->categories);

        flash($type->name . ' <strong>updated</strong> successfully')->success();
        return redirect()->route('types.show', $type->id);
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
