<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Passenger;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index()
    {

        $passengerCollection = Passenger::latest();

        // if (request('search')) {
        //     $passengerCollection = $passengerCollection
        //         ->where('passenger_id', 'like', '%' . request('search') . '%')
        //         ->orWhere('year', 'like', '%' . request('search') . '%');
        // }

        $passenger = $passengerCollection->paginate(10);

        return view('backend.passenger.index', [
            'passengers' => $passenger
        ]);
    }

    public function create()
    {
        // $this->authorize('create-markinput');
        $cours = Driver::all();
    
        $passengers = Passenger::all();
        return view('backend.passenger.create', [
            'passengers' => $passengers,
        ]);
    }

    public function store(Request $request)
    {
        //  @dd($request);
        $cours = Driver::all();
        $passengers = Passenger::all();
        try {
            Passenger::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('passengers.index')->with('success', 'Passenger created successfully');
    }

    public function edit($id)
    {
        $passenger = Passenger::findOrFail($id);
        return view('backend.passenger.edit', [
            'single_passenger' => $passenger
        ]);
    }

    public function update(Request $request, $id)
    {
        $passenger = Passenger::findOrFail($id);

        try {
            $passenger->update([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('passengers.index')->with('success', 'Passenger updated successfully');
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

        return redirect()->route('passengers.index')->with('success', 'Passenger deleted successfully');
    }

    public function show($id)
    {
        $passenger = Passenger::findOrFail($id);
        return view('backend.passenger.show', [
            'show_passenger' => $passenger,
        ]);
    }
}
