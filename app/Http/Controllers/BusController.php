<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Trip;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::all();
        return view('backend.buses.index', compact('buses'));
    }

    public function create()
    {
        return view('backend.buses.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            // unset($data['_token']);
            $busdata =  Bus::create([
                'name' => $data['name'],
                'reg_number' => $data['reg_number'],
                'no_of_seat' => $data['no_of_seat'],
                'features_details' => $data['features_details'],
                'other_details' => $data['other_details'],
            ]);

            if ($request->images && count($request->images) > 0) {
                $images = [];
                for ($i = 0; $i < count($request->images); $i++) {
                    $image = $request->images[$i];
                    $filename = time() . $i . '.' . $image->getClientOriginalExtension();
                    $location = public_path('images/Buses/');
                    $image->move($location, $filename);
                    $images[$i] = $filename;
                    sleep(1);
                }
                $busdata->update([
                    'images' => json_encode($images),
                ]);
            }

            return redirect()->route('buses.index')->withMessage("Successfully created bus with user");
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $single_buse = Bus::find($id);
        return view('backend.buses.edit', compact('single_buse'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            $bus = Bus::find($id);
            $bus->update([
                'name' => $data['name'],
                'reg_number' => $data['reg_number'],
                'no_of_seat' => $data['no_of_seat'],
                'features_details' => $data['features_details'],
                'other_details' => $data['other_details'],
            ]);

            return redirect()->route('buses.index')->withMessage("Successfully updated bus");
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        // dd($id);
        try {

            $date = Carbon::now()->format('Y-m-d');
            $bus = Bus::find($id);
            $trips = Trip::where('bus_id', $id)->where('start_date', '>=', $date)->get();
            if (count($trips) > 0) {
                $trips->delete();
            }
            
            $bus->delete();
            foreach (json_decode($bus->images) as $image) {
                $location = public_path('images/Buses/' . $image);
                if (file_exists($location)) {
                    unlink($location);
                }
            }

            return redirect()->route('buses.index')->withMessage("Successfully deleted bus");
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show($id)
    {
        $show_buse = Bus::find($id);
        return view('backend.buses.show', compact('show_buse'));
    }

    public function getTripsByBus($bus_id)
    {
        $date = date('Y-m-d');
        $trips = Trip::where('start_date', '>=', $date)->where('bus_id', $bus_id)->get();

        foreach ($trips as $trip) {
            $trip->event = $trip->event;
        }

        $buss = Bus::where('id', '!=', $bus_id)->get();
        return response()->json([$trips, $bus_id, $buss]);
    }

    public function updateTripBus($trip_id, $bus_id)
    {
        try {
            $trip = Trip::where('id', $trip_id)->first();
            $trip->bus_id = $bus_id;
            $trip->update();

            return response()->json(true);
        } catch (\Exception $e) {
            return response()->json(false);
        }
    }
}
