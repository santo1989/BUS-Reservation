<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function index()
    {

        $driverCollection = Driver::latest();

        if (request('search')) {
            $driverCollection = $driverCollection
                ->where('driver_name', 'like', '%' . request('search') . '%')
                ->orWhere('bus_name', 'like', '%' . request('search') . '%');
        }

        $driver = $driverCollection->paginate(10);

        return view('backend.driver.index', [
            'drivers' => $driver
        ]);
    }

    public function create()
    {
        // $this->authorize('create-driver');

        return view('backend.driver.create');
    }

    public function store(Request $request)
    {
        //  @dd($request);
        try {
            Driver::create([
                'driver_name' => $request->driver_name,
                'contract_number' => $request->contract_number,
                'bus_name' => $request->bus_name,
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('driver.index')->withMessage('Successfully Created!');
    }


    public function edit(Driver $driver)
    {
        return view('backend.driver.edit', [
            'single_driver' => $driver
        ]);
    }

    public function show(Driver $driver)
    {
        return view('backend.driver.show', [
            'show_driver' => $driver
        ]);
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::find($id);

        $driver->update([

            'driver_name' => $request->driver_name,
            'contract_number' => $request->contract_number,
            'bus_name' => $request->bus_name,

        ]);

        $driver->update();


        return redirect()->route('driver.index');
    }

    public function destroy(Driver $driver)
    {
        try {
            $driver->delete();
            return redirect()->route('driver.index')->withMessage('Successfully Deleted!');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
