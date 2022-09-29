<?php

namespace App\Http\Controllers;


use App\Models\Event;
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
            $event =  [
                'name' => $request->name,
                'details' => $request->details

            ];

            $images = [];

            if (count($request->images) > 0) {
                // dd('check');
                for ($i = 0; $i < count($request->images); $i++) {
                    $image = $request->images[$i];
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $location = public_path('images/events/' . $filename);
                    $image->move($location, $filename);
                    $images[$i] = $filename;
                    sleep(1);
                }
                $event = array_merge($event, ['images' => json_encode($images)]);
                Event::create($event);
            }

            return redirect()->route('events.index')->withMessage('Successfully Created!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Event $event_show)
    {
        $event_show->images = json_decode($event_show->images);

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

    public function destroy(Event $event_id)
    {
        try {
            $event_id->delete();
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
        // for($i = 0; $i < count(json_decode($event->images)); $i++){
        //     $image = json_decode($event->images)[$i];
        //     unlink(storage_path('/images/events/' . $image));
        // }
        $event->forceDelete();
        return redirect()->route('events.trashed')->withMessage('Successfully Deleted Permanently!');
    }
}
