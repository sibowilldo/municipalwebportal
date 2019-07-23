<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TypeResource;
use App\Incident;
use App\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TypeResource::collection(Type::get());
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
        $type = Type::findOrFail($id);
        return new TypeResource($type);
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


    public function chart_types()
    {
        $data = [];
        $today = Carbon::now();
        $types = Type::all('id', 'name', 'state_color');//whereDate('created_at','2019-07-18')->get();//
        $incidents = Incident::whereBetween('created_at', [$today->startOfWeek()->format('Y-m-d H:i'), $today->endOfWeek()->format('Y-m-d H:i')])->get();
        foreach ($types as $type){
            $series = new Series($type->name, $type->state_color, count($incidents->where('type_id', $type->id)));
            array_push($data, $series);
        }
        return response()
            ->json([
                'start' => $today->startOfWeek()->format('Y-m-d H:i'),
                'end' => $today->endOfWeek()->format('Y-m-d H:i'),
                'data' => $data]);
    }
}

class Series{
    public $label;
    public $color;
    public $data;

    public function __construct($label, $color, $data)
    {
        $this->label = $label;
        $this->color = $color;
        $this->data = $data;
    }
}
