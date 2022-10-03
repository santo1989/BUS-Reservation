<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
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
        $events = Event::all();
        // dd($events);
        return view('frontend.events.fleet', compact('events'));
    }

    public function fleet_details($id)
    {
        $event = Event::find($id);
        $event->images = json_decode($event->images, true);
        return view('frontend.events.fleets-details', compact('event'));
    }
}
