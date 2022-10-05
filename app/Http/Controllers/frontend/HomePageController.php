<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Trip;
use Exception;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function contactUS()
    {
        return view('frontend.contact-us');
    }

    public function fleets()
    {

        $eventCollection = Event::all();

        if (request('search')) {
            $eventCollection = $eventCollection
                ->where('name', 'like', '%' . request('search') . '%');
        }

        $events = $eventCollection;

        return view('frontend.events.fleet', [
            'events' => $events
        ]);
    }

    public function fleet_details($id)
    {
        $event = Event::find($id);
        $event->images = json_decode($event->images, true);
        return view('frontend.events.fleets-details', compact('event'));
    }

    public function trip($id)
    {

        $event = Event::find($id);
        $trips = Trip::where('event_id', $event->id)->get();
        // dd($trips);
        if (!$trips->count() > 0) {
            return redirect()->route('login');
        } else {

            try {
                $event_trips_count = Trip::where('event_id', $id)->count();



                // dd($trips);
                $stoppages = $trips->map(function ($trip) {
                    $trip->stoppages == null ? $trip->stoppages = [] : $trip->stoppages = json_decode($trip->stoppages, true);
                    // $trip->stoppages = json_decode($trip->stoppages, true);
                    return $trip;
                });

                $events_name = Event::where('id', $id)->get(); //get event name


                return view('frontend.trip', compact('trips', 'event_trips_count', 'event', 'events_name'));
            } catch (Exception $e) {
                $event->trips = null;
                $event->trip_count = 0;
                return back()->with('error', 'No trips found for this event');
            }
        }
    }

    public function transport()
    {
        return view('frontend.transport');
    }

    public function transport_details()
    {
        return view('frontend.transport-details');
    }
}
