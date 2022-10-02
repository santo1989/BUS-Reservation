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

    public function events()
    {
        return view('frontend.events');
    }

    public function event_details($id)
    {
        $event = Event::find($id);
        return view('frontend.events-details', compact('event'));
    }
}

