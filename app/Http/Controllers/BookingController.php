<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Passenger;
use App\Models\Event;
use App\Models\Trip;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BookingController extends Controller
{
    public function index()
    {
        $date = date("Y-m-d");
        $unq_event_ids = Trip::where('start_date', '>=', $date)->pluck('event_id')->unique();
        $events = array();
        foreach ($unq_event_ids as $event_id) {
            $event = Event::where('id', $event_id)->first();
            array_push($events, $event);
        }
        foreach ($events as $event) {
            $event->trips = Trip::where('event_id', $event->id)->where('start_date', '>=', $date)->get();
            $event->trip_count = $event->trips->count();
        }
        //dd($events);
        return view('backend.bookings.index', ['evs' => $events]);
    }

    public function getBookings($trip_id)
    {
        $bookings = Booking::where('trip_id', $trip_id)->get();

        foreach ($bookings as $booking) {
            $booking->passenger = $booking->passenger;
            $booking->trip = $booking->trip;
        }


        return response()->json($bookings);
    }

    public function create()
    {
        $passengers = Passenger::all();
        $events = Event::all();
        return view('backend.bookings.create', [
            'passengers' =>  $passengers,
            'events' =>  $events,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);

            $trip = Trip::where('id', $request->trip_id)->first();
            $newAvailable = $trip->available_seats - $request->no_of_seat;
            if ($newAvailable < 0) {
                return redirect()->back()->withError('No of seats not available');
            }
            $trip->update([
                'available_seats' => $newAvailable
            ]);

            $booking = Booking::create($data);

            return redirect()->route('bookings.index')->withMessage("Successfully created a booking");
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($booking_id)
    {
        $booking = Booking::where('id', $booking_id)->first();
        $passengers = Passenger::all();
        $events = Event::all();
        $trips = Trip::where('event_id', $booking->event_id)->get();
        $stoppages = json_decode($booking->trip->stoppages, true);
        // dd($stoppages);
        $sl = 0;
        $modStoppages = [];
        foreach ($stoppages as $location => $time) {
            $modStoppages[$sl] = "$location:$time";
        }
        // dd($modStoppages);
        return view('backend.bookings.edit', compact('booking', 'passengers', 'events', 'trips', 'modStoppages'));
    }

    public function update(Request $request, $booking_id)
    {
        // dd($request->all());
        try {
            $booking = Booking::where('id', $booking_id)->first();
            $data = $request->all();
            unset($data['_token']);
            unset($data['_method']);

            $trip = Trip::where('id', $request->trip_id)->first();
            $newAvailable = $trip->available_seats - $request->no_of_seat;
            if ($newAvailable < 0) {
                return redirect()->back()->withError('No of seats not available');
            }
            $trip->update([
                'available_seats' => $newAvailable
            ]);

            $booking->update($data);

            return redirect()->route('bookings.index')->withMessage("Successfully updated booking");
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($booking_id)
    {
        // dd($booking_id);
        $booking = Booking::where('id', $booking_id)->first();

        $trip = Trip::where('id', $booking->trip_id)->first();
        $trip->update([
            'available_seats' => $trip->available_seats + $booking->no_of_seat
        ]);

        $booking->delete();

        return redirect()->route('bookings.index')->withMessage('Booking deleted');
    }

    public function getTrips($event_id)
    {
        $date = date('Y-m-d');
        $trips = Trip::where('start_date', '>=', $date)->where('event_id', '=', $event_id)->get();
        return response()->json($trips);
    }

    public function getStoppages($trip_id)
    {
        $trip = Trip::where('id', $trip_id)->first();
        $stoppagesJson = json_decode($trip->stoppages, true);
        // $stoppages = array();

        // foreach ($stoppagesJson as $location => $time)
        // {
        //     $stoppages[$location] = $time;
        // }
        return response()->json($stoppagesJson);
    }

    public function getAvailableSeat($trip_id)
    {
        $availableSeat = Trip::where('id', $trip_id)->first()->available_seats;
        return response()->json($availableSeat);
    }
}
