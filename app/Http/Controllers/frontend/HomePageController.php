<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Event;
use App\Models\User;
use App\Models\Passenger;
use App\Models\Trip;
use Exception;
use Illuminate\Http\Request;
use Mockery\Generator\Parameter;
use Redirect; 
class HomePageController extends Controller
{
    public function index()
    {
        // dd(session('passenger'));
        // dd(check());
        return view('frontend.index');
    }

    public function contactUS()
    {
        return view('frontend.contact-us');
    }

    public function fleets()
    {

        $events = Event::all();

        return view('frontend.events.fleet', [
            'events' => $events
        ]);
    }

    public function fleet_details($id)
    {
        $event = Event::find($id);
        //$event->images = json_decode($event->images, true);
        $date = date('Y-m-d');
        $event->trips = $event->trips->where('start_date', '>=', $date)->sortBy('start_date');
        $trips = Trip::where('event_id', $event->id)->get();
        $dates = Trip::where('event_id', $event->id)->get()->groupBy('start_date');

        $timeFormat = 12;

        if(Session()->has('user')) {
            $timeFormat = User::where('id', session('user')->id)->first()->time_format;
        }
        // dd($event, $dates);
        return view('frontend.events.fleets-details', compact('trips', 'event', 'dates', 'timeFormat'));
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
                return back()->withErrors('No trips found for this event');
            }
        }
    }

    public function transport()
    {
        $buses = Bus::all();
        return view('frontend.transport', compact('buses'));
    }

    public function transport_details($bus_id)
    {
        $bus = Bus::find($bus_id);
        $bus->images = json_decode($bus->images, true);
        return view('frontend.transport-details', compact('bus'));
    }

    public function getPassenger($user_id, $trip_id)
    {
        // dd($user_id,$trip_id);
        $passenger = Passenger::where('user_id', $user_id)->first();
        // dd($passenger);
        $trip = Trip::where('id', $trip_id)->first();
        $trip->bus = $trip->bus;
        $trip->driver = $trip->driver;
        $trip->event = $trip->event;
        $trip->stoppages = json_decode($trip->stoppages, true);

        return response()->json([$passenger, $trip]);
    }

    public function passengerLogin()
    {
        $prevRoute = app('router')->getRoutes()->match(app('request')->create(url()->previous()));

        $route['routeName'] = $prevRoute->getName();
        $route['parameter'] = $prevRoute->parameters['id'] ?? '';
        // dd($route);

        Redirect::setIntendedUrl(url()->previous());
        return view('frontend.passenger_login', compact('prevRoute', 'route'));
    }

    public function passengerRegister()
    {
        return view('frontend.passenger_register');
    }

    public function passengerPasswdChangeRequest()
    {
        return view('frontend.passengerPasswdChangeRequest');
    }



    public function passengerPasswdReset()
    {
        return view('frontend.passengerPasswdReset');
    }



}
