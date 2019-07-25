<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use App\System;
use App\Type;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesFormRequest;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::pluck('name', 'id');
        $state_colors = System::$state_colors;
        return view('backend.categories.create', compact('types', 'state_colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoriesFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesFormRequest $request)
    {
        $request['is_active'] = $request->is_active ? true : false;
        $category = Category::create($request->only(['name', 'description', 'is_active']));
        $category->types()->attach($request->types);

        flash($category->name . ' Category <strong>saved</strong> successfully')->success();
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('backend.categories.show', compact('category'));
    }

    public function jsonShowByType(Type $type)
    {
//        $type = Type::where('id', $id)->gert();

        printf($type->categories()->pluck('name', 'id'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::with('types')->findOrFail($id);
        $types = Type::pluck('name', 'id');
        $state_colors = System::$state_colors;

        return view('backend.categories.edit', compact('category', 'types', 'state_colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoriesFormRequest  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesFormRequest $request, Category $category)
    {
        $request['is_active'] = $request->is_active ? true : false;
        $category->update($request->only(['name', 'description', 'is_active', 'state_color']));
        $category->types()->sync($request->types);

        flash($category->name . ' <strong>updated</strong> successfully')->success();
        return redirect()->route('categories.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $category->delete();

        return response()->json([
            "message"=> $category->name . ' was deleted successfully',
            "url" => route('categories.index')
        ], 200);
    }

    public function jsonIndex()
    {
        return response()->json(['data' => Category::all('id', 'name', 'is_active', 'state_color')]);
    }
}
