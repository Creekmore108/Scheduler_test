<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Employee;
use App\Resource;

class EventController extends Controller
{
    public function index(Request $request){
        $events = new Event();
        $employees = new Employee();
        $resources = new Resource();

        $from = $request->from;
        $to = $request->to;

        return response()->json([
            "data" => $events->
                where("start_date", "<", $to)->
                where("end_date", ">=", $from)->get(),
            "collections" => [
                "employees" => $employees->select("id as key", "full_name as label")->get(),
                "resources" => $resources->select("id as key", "resource_name as label")->get(),
                "color" => $resources->select("id as key", "color as label")->get()
            ]
        ]);
    }

    public function store(Request $request){
        $event = new Event();

        $event->text = strip_tags($request->text);
        $event->employee_id = $request->employee_id;
        $event->resource_id = $request->resource_id;
        //$event->color = $request->color;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->save();

        return response()->json([
            "action"=> "inserted",
            "tid" => $event->id
        ]);
    }

    public function update($id, Request $request){
        $event = Event::find($id);

        $event->text = strip_tags($request->text);
        $event->employee_id = $request->employee_id;
        $event->resource_id = $request->resource_id;
        $event->color = $request->color;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->save();

        return response()->json([
            "action"=> "updated"
        ]);
    }

    public function destroy($id){
        $event = Event::find($id);
        $event->delete();

        return response()->json([
            "action"=> "deleted"
        ]);
    }
}
