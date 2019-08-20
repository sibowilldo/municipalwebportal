<?php

namespace App\Http\Controllers;

use App\Incident;
use App\Status;
use App\Type;
use Carbon\Carbon;

class ChartController extends Controller
{

    public function statuses()
    {
        $data = [];
        $today = Carbon::now();
        $statuses = Status::all();
        $incidents = Incident::whereBetween('created_at', [$today->startOfWeek()->format('Y-m-d H:i'), $today->endOfWeek()->format('Y-m-d H:i')])->get();
        foreach ($statuses as $status){
            $series = new ChartSeries($status->name, $status->state_color->css_color, count($incidents->where('status_id', $status->id)));
            array_push($data, $series);
        }
        return response()
            ->json([
                'start' => $today->startOfWeek()->format('Y-m-d H:i'),
                'end' => $today->endOfWeek()->format('Y-m-d H:i'),
                'data' => $data]);
    }

    public function types()
    {
        $data = [];
        $today = Carbon::now();
        $types = Type::all('id', 'name', 'state_color_id');
        $incidents = Incident::whereBetween('created_at', [$today->startOfWeek()->format('Y-m-d H:i'), $today->endOfWeek()->format('Y-m-d H:i')])->get();
        foreach ($types as $type){
            $series = new ChartSeries($type->name, $type->state_color->css_color, count($incidents->where('type_id', $type->id)));
            array_push($data, $series);
        }
        return response()
            ->json([
                'start' => $today->startOfWeek()->format('Y-m-d H:i'),
                'end' => $today->endOfWeek()->format('Y-m-d H:i'),
                'data' => $data]);
    }
}

class ChartSeries{
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
