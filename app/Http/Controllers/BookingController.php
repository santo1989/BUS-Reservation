<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BookingController extends Controller
{
    public function index()
    {
        $date = date("Y-m-d");
        $unq_event_ids = Trip::where('start_date', '>=', $date)->pluck('event_id')->unique();
        $events = array();
        foreach ($unq_event_ids as $event_id)
        {
            $event = Event::where('id', $event_id)->first();
            array_push($events, $event);
        }
        foreach ($events as $event)
        {
            $event->trips = Trip::where('event_id', $event->id)->where('start_date', '>=', $date)->get();
            $event->trip_count = $event->trips->count();
        }
        // dd($events);
        return view('backend.bookings.index', compact('events'));
    }

    public function getBookings($trip_id)
    {
        $bookings = Booking::where('trip_id', $trip_id)->get();

        foreach ($bookings as $booking)
        {
            $booking->passenger = $booking->passenger;
            $booking->trip = $booking->trip;
        }


        return response()->json($bookings);
    }
}