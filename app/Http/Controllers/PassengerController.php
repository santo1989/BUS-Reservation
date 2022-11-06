<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\Passenger;
use App\Models\Trip;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PassengerController extends Controller
{
    public function index()
    {

        $passengerCollection = Passenger::latest();

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
            return redirect()->back()->withErrors('Error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Error: ' . $e->getMessage());
        }

        return redirect()->route('passengers.index')->withMessage('Passenger created successfully');
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
            return redirect()->back()->withErrors('Error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Error: ' . $e->getMessage());
        }

        return redirect()->route('passengers.index')->withMessage('Passenger updated successfully');
    }

    public function destroy($id)
    {
        $passenger = Passenger::findOrFail($id);
        try {
            $passenger->delete();
        } catch (QueryException $e) {
            return redirect()->back()->withErrors('Error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Error: ' . $e->getMessage());
        }

        return redirect()->route('passengers.index')->withMessage('Passenger deleted successfully');
    }

    public function show($id)
    {
        $passenger = Passenger::findOrFail($id);
        return view('backend.passenger.show', [
            'show_passenger' => $passenger,
        ]);
    }
    public function checkPassengers()
    {

        $driverId = auth()->user()->driver->id;
        $currentDate = date('Y-m-d');
        $trips = Trip::where('driver_id', $driverId)
            ->where('start_date', '>=', $currentDate)->orderBy('start_date')->get();

        return view('backend.driver.trips', [
            'trips' => $trips
        ]);
    }

    public function passengerList($trip_id)
    {

        //dd($trip_id);
        $bookings = Booking::where('trip_id', $trip_id)->get();
        return view('backend.driver.passenger_list', [
            'bookings' => $bookings
        ]);
    }

    public function passengerPasswordChange(Request $request)
    {
        if ($request->email && $request->phone) {
            $username = User::where('email', $request->email)->first();
            $userPhone = Passenger::where('phone', $request->phone)->first();
            if ($username && $userPhone == true) {
                return view('frontend.passengerPasswdReset', [
                    'user_id' => $username->id
                ]);
            } else {
                return redirect()->back()->withErrors('Email or Phone number is not correct');
            }
        } else {
            return redirect()->back()->withErrors('Email or Phone  is not correct');
        }
    }

    public function passengerPasswordResetUpdate(Request $request)
    {
        // @dd($request);
        $user = User::findOrFail($request->user_id);
        if ($request->password == $request->password_confirmation) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('Phantom-Tranzit')->withMessage('Password reset successfully');
        } else {
            return redirect()->back()->withErrors('Password and confirm password does not match');
        }
    }
}
