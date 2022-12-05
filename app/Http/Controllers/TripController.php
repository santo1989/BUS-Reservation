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
    
    public function index()
    {
        $trips = Trip::latest()->get();
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
        try {
            // dd($request->all());
            $stoppages = [];
            $limit = count($request->stoppages);
            // $times = $request->times = array_values($request->stoppages);  
            for ($i = 0; $i < $limit; $i++) {
                // time convert to 12 hour format

                //$stoppages[$request->stoppages[$i]] = date("h:i A", strtotime($request->times[$i]));
                $stoppages[$request->stoppages[$i]] = $request->times[$i];
                // dd(json_encode($stoppages));
            }
                $tripCode = $this->generateTripCode($request->event_id, $request->start_date);
            $availableSeats = Bus::where('id', $request->bus_id)->first()->no_of_seat;

            $trip = Trip::create([
                'event_id' => $request->event_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'stoppages' => json_encode($stoppages),
                // 'start_location' => $request->start_location,
                // 'end_location' => $request->end_location,
                'bus_id'    => $request->bus_id,
                'driver_id' => $request->driver_id,
                'trip_details' => $request->trip_details,
                'trip_code' => $tripCode,
                'available_seats' => $availableSeats,
            ]);


            return redirect()->route('trips.index')->withMessage("Successfully created trip");
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function generateTripCode($event_id, $trip_date)
    {
        $event = Event::find($event_id);
        $trip_date = $trip_date;
        return str_replace(' ', '_', $event->name) . '_' .str_replace('-', '/', $trip_date);
    }

    public function edit($trip_id)
    {
        $events = Event::all();
        $buses = Bus::all();
        $drivers = Driver::all();
        $trip = Trip::where("id", $trip_id)->first();
        $trip->stoppages = json_decode($trip->stoppages);

        // dd($trip);
        return view('backend.trips.edit', [
            'events' =>  $events,
            'buses' =>  $buses,
            'drivers' =>  $drivers,
            'trip' => $trip
        ]);
    }

    public function update(Request $request, $trip_id)
    {

        $trip = Trip::where("id", $trip_id)->first();
        $stoppages = [];
        $limit = count($request->stoppages);
        for ($i = 0; $i < $limit; $i++) {
            // $stoppages[$request->stoppages[$i]] = date("h:i A", strtotime($request->times[$i]));
            $stoppages[$request->stoppages[$i]] = $request->times[$i];
            // $times = date("h:i A", strtotime($request->stoppages[$i]['times']));
            // $stoppages[$request->stoppages[$i]] = $times;
            // $stoppages[$request->stoppages[$i]] = $request->times[$i];
        }
        $availableSeats = Bus::where('id', $request->bus_id)->first()->no_of_seat;
        $trip->trip_code = $this->generateTripCode($request->event_id, $request->start_date, $trip->id);
        $trip->update([
            'event_id' => $request->event_id,
            'trip_details' => $request->trip_details,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'stoppages' => json_encode($stoppages),
            // 'start_location' => $request->start_location,
            // 'end_location' => $request->end_location,
            'bus_id' => $request->bus_id,
            'driver_id' => $request->drivers_id,
            'available_seats' => $availableSeats,
            'trip_code' => $trip->trip_code,

        ]);


        return redirect()->route('trips.index')->withMessage("Successfully updated trip");
    }

    public function delete($trip_id)
    {
        $trip = Trip::where("id", $trip_id)->first()->delete();
        return redirect()->route('trips.index')->withMessage("Successfully deleted trip");
    }
}
