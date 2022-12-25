<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Trip;
use Exception;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EventController extends Controller
{


    public function index()
    {

        $eventsCollection = Event::latest();

        if (request('search')) {
            $eventsCollection = $eventsCollection
                ->where('description', 'like', '%' . request('search') . '%');
        }

        $events = $eventsCollection->paginate(10);

        return view('backend.events.index', [
            'events' => $events
        ]);
    }

    public function create()
    {
        // $this->authorize('create-event');

        return view('backend.events.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'details' => 'required',
        ]);

        try {
            $event =  Event::create([
                'name' => $request->name,
                'details' => $request->details
            ]);

            if ($request->file('images')) {
                $file = $request->file('images');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/images/events/'), $filename);
                $driverData['images'] = $filename;
            }

            $event->update($driverData);



            // if ($request->images && count($request->images) > 0) {
            //     $images = [];
            //     for ($i = 0; $i < count($request->images); $i++) {
            //         $image = $request->images[$i];
            //         $filename = time() . '.' . $image->getClientOriginalExtension();
            //         $location = public_path('images/events/');
            //         $image->move($location, $filename);
            //         $images[$i] = $filename;
            //         sleep(1);
            //     }
            //     $event->update([
            //         'images' => json_encode($images),
            //     ]);
            // }

            return redirect()->route('events.index')->withMessage('Successfully Created!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Event $event_show)
    {
        // $event_show->images = json_decode($event_show->images);
        // dd($event_show);
        return view('backend.events.show', [
            'event_show' => $event_show,

        ]);
    }

    public function edit($single_event)
    {
        $event = Event::find($single_event);
        return view('backend.events.edit', [
            'single_event' => $event
        ]);
    }

    public function update(Request $request, $update_event)
    {

        // dd($request->all());
        try {
            $event = Event::find($update_event);
            $requestData = [
                'name' => $request->name,
                'details' => $request->details
            ];

            if ($request->file('images')) {
                $file = $request->file('images');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/images/events/'), $filename);
                $requestData['images'] = $filename;
            }
            // if (request()->hasfile('images[]')) {
            //     for ($i = 0; $i < count($request->file('images[]')); $i++) {
            //         $image = $request->file('images[]')[$i];
            //         $filename = time() . '.' . $image->getClientOriginalExtension();
            //         $location = public_path('storage/events/' . $filename);
            //         Image::make($image)->resize(800, 400)->save($location);
            //         $requestData['images'][] = $filename;
            //     }
            // }


            //  dd($requestData);
            $event->update($requestData);


            return redirect()->route('events.index')->withMessage('Successfully Updated!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(Event $event)
    {
        // dd($event);
        try {
            $date = Carbon::now()->format('Y-m-d');
            $trips = Trip::where('event_id', $event->id)->where('start_date', '>=', $date)->get();
            if (count($trips) > 0) {
                $trips->delete();
            }

            unlink(public_path('/images/events/' . $event->images));

            // unlink(public_path('images/events/' . $event->images));

            // foreach (json_decode($event->images) as $image) {
            //     $location = public_path('images/Events/' . $image);
            //     if (file_exists($location)) {
            //         unlink($location);
            //     }
            // }

            $event->forceDelete();
            return redirect()->route('events.index')->withMessage('Successfully Deleted!');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    // Softdelete
    public function trash()
    {
        $events = Event::onlyTrashed()->get();

        return view('backend.events.trashed', [
            'events' => $events
        ]);
    }

    public function restore($id)
    {
        $event = Event::onlyTrashed()->findOrFail($id);
        $event->restore();
        return redirect()->route('events.trashed')->withMessage('Successfully Restored!');
    }

    public function delete($id)
    {
        $event = Event::onlyTrashed()->findOrFail($id);
        $event->forceDelete();
        return redirect()->route('events.trashed')->withMessage('Successfully Deleted Permanently!');
    }

    public function getTripsByEvent($event_id)
    {
        $date = date('Y-m-d');
        $trips = Trip::where('start_date', '>=', $date)->where('event_id', $event_id)->get();
        // dd($trips);

        foreach ($trips as $trip) {
            $trip->event = $trip->event;
        }

        $events = Event::where('id', '!=', $event_id)->get();
        return response()->json([$trips, $event_id, $events]);
    }

    public function updateTripEvent($trip_id, $event_id)
    {
        try {
            $trip = Trip::where('id', $trip_id)->first();
            $trip->event_id = $event_id;
            $trip->update();

            return response()->json(true);
        } catch (\Exception $e) {
            return response()->json(false);
        }
    }
}
