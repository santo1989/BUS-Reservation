<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            $password = $request->password;
            $confirmedPassword  = $request->confirmedPassword;
            if($password === $confirmedPassword)
            {
                $userData = [
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id'  => 2
                ];

                $user = User::create($userData);

                $driverData = [
                    'name'    => $request->name,
                    'phone'   => $request->phone,
                    'email'   => $request->email,
                    'user_id' => $user->id
                ];
                Driver::create($driverData);
            }else{
                return redirect()->back()->with('error', "Password didn't match");
            }
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
