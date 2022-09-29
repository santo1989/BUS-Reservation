<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Driver;
use App\Models\Event;
use Exception;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Image;

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
            Event::create([
                'name' => $request->name,
                'details' => $request->details
                
            ]);

            return redirect()->route('events.index')->withMessage('Successfully Created!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Event $event)
    {
        return view('backend.events.show', [
            'events' => $event
        ]);
    }

    public function edit($event_id)
    {
        $event = Event::find($event_id);
        return view('backend.events.edit', [
            'single_event' => $event
        ]);
    }

    public function update(Request $request, $event_id)
    {
        
        // dd($request->all());
        try {
            $event = Event::find($event_id);
            $requestData = [
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'time' => $request->time,
                'fee' => $request->fee,
                'location' => $request->location,
            ];
            if (request()->file('img1')) {
                $requestData['img1'] = $this->uploadimg(request()->file('img1'));
            }
           
            
            //  dd($requestData);
            $event->update($requestData);


            return redirect()->route('events.index')->withMessage('Successfully Updated!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(Event $event)
    {
        try {
            $event->delete();
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
        unlink(public_path('storage/events/' . $event->img1));
        $event->forceDelete();
        return redirect()->route('events.trashed')->withMessage('Successfully Deleted Permanently!');
    }

    public function uploadimg($file)
    {
        
         $fileName = time() . '.' . $file->getClientOriginalExtension();

        Image::make($file)
            ->resize(420, 420)
            ->save(storage_path() . '/app/public/events/' . $fileName);

        return $fileName;
    }
}
