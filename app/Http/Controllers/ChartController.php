<?php

namespace App\Http\Controllers;

use App\Incident;
use App\Status;
use App\Type;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function incidents()
    {
        $data = [];
        $today = Carbon::now();
        $from = $today->startOfMonth()->format('Y-m-d H:i');
        $to = $today->endOfMonth()->format('Y-m-d H:i');

        $incidents = Incident::select([
            DB::raw('DATE_FORMAT(created_at, \'%d %b %Y\') AS date'),
//            DB::raw('created_at AS date'),//DATE_FORMAT(created_at, \'%d %b %Y\')
            DB::raw('COUNT(*) AS total'),
            ])
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('date')
            ->orderBy('date', 'ASC')->get();

        foreach ($incidents as $incident){
            $dateFormat = new Carbon($incident->date);
            $series = new ChartSeries($dateFormat->format('d M Y'), '', $incident->total);
            array_push($data, $series);
        }

        return response()
            ->json([
                'start' => $from,
                'end' => $to,
                'data' => $data]);
    }

    public function statuses()
    {
        $data = [];
        $today = Carbon::now();
        $statuses = Status::all();
        $incidents = Incident::whereBetween('created_at', [$today->startOfWeek()->format('Y-m-d H:i'), $today->endOfWeek()->format('Y-m-d H:i')])->Orderby('created_at')->get();
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
