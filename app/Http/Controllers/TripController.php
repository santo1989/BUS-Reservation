<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\Trip;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TripController extends Controller
{
    //
    public function index()
    {
        $trips = Trip::all();
        return view('backend.trips.index', compact('trips'));
    }

    public function create()
    {
        $events = Event::all();
        $buses = Bus::all();
        $drivers = Driver::all();
        return view('backend.trips.create', [
            'events' =>  $events, 
            'buses' =>  $buses, 
            'drivers' =>  $drivers 
        ]);
    }

    public function store(Request $request)
    {
        //dd($request);
        try {
            $data = $request->all();
            $data['stoppages']  = json_encode($data['stoppages']); 
            $trip = Trip::create($data);


            return redirect()->route('trips.index')->withMessage("Successfully created trip");
            
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    public function edit($trip_id)
    {
        $events = Event::all();
        $buses = Bus::all();
        $drivers = Driver::all();
        $trip = Trip::where("id", $trip_id)->first();
        return view('backend.trips.edit', [
            'events' =>  $events, 
            'buses' =>  $buses, 
            'drivers' =>  $drivers ,
            'trip' =>$trip
        ]);
    }

    public function update(Request $request, $trip_id)
    {
       
        $trip = Trip::where("id", $trip_id)->first();
        $trip->update([
            'event_id' => $request->event_id,
            'trip_details' => $request->trip_details,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'stoppages' => $request->stoppages,
            'start_location' => $request->start_location,
            'end_location' => $request->end_location,
            'bus_id' => $request->bus_id,
            'drivers_id' => $request->drivers_id
        ]);

        
        return redirect()->route('trips.index')->withMessage("Successfully updated trip");
            
    }

    public function delete($trip_id)
    {
        $trip = Trip::where("id", $trip_id)->first()->delete();
        return redirect()->route('trips.index')->withMessage("Successfully deleted trip");
    }
}
