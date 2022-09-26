<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Passenger;
use App\Models\Year;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index()
    {

        $passengerCollection = Passenger::latest();

        if (request('search')) {
            $passengerCollection = $passengerCollection
                ->where('passenger_id', 'like', '%' . request('search') . '%')
                ->orWhere('year', 'like', '%' . request('search') . '%');
        }

        $passenger = $passengerCollection->paginate(10);

        return view('backend.passenger.index', [
            'passengers' => $passenger
        ]);
    }

    public function create()
    {
        // $this->authorize('create-markinput');
        $cours = Driver::all();
        $year = Year::all();
        $passengers = Passenger::all();
        return view('backend.passenger.create', [
            'drivers' => $cours,
            'years' => $year,
            'passengers' => $passengers,
        ]);
    }

    public function store(Request $request)
    {
        //  @dd($request);
        $cours = Driver::all();
        $year = Year::all();
        $passengers = Passenger::all();
        try {
            Passenger::create([
                'user_id' => $request->user_id,
                'passenger_id' => $request->passenger_id,
                'year' => $request->year,
                'up_location' => $request->up_location,
                'driver_name' => $request->driver_name,
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('passenger.index')->with('success', 'Passenger created successfully');
    }

    public function edit($id)
    {
        $passenger = Passenger::findOrFail($id);
        $cours = Driver::all();
        $year = Year::all();
        $passengers = Passenger::all();
        return view('backend.passenger.edit', [
            'single_passenger' => $passenger,
            'drivers' => $cours,
            'years' => $year,
            'passengers' => $passengers,
        ]);
    }

    public function update(Request $request, $id)
    {
        $passenger = Passenger::findOrFail($id);
        $cours = Driver::all();
        $year = Year::all();
        $passengers = Passenger::all();

        try {
            $passenger->update([
                'user_id' => $request->user_id,
                'passenger_id' => $request->passenger_id,
                'year' => $request->year,
                'up_location' => $request->up_location,
                'driver_name' => $request->driver_name,
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('passenger.index')->with('success', 'Passenger updated successfully');
    }

    public function destroy($id)
    {
        $passenger = Passenger::findOrFail($id);
        try {
            $passenger->delete();
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('passenger.index')->with('success', 'Passenger deleted successfully');
    }

    public function show($id)
    {
        $passenger = Passenger::findOrFail($id);
        $cours = Driver::all();
        $year = Year::all();
        $passengers = Passenger::all();
        return view('backend.passenger.show', [
            'show_passenger' => $passenger,
            'drivers' => $cours,
            'years' => $year,
            'passengers' => $passengers,
        ]);
    }
}
