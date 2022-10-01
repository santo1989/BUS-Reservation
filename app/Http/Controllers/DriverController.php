<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\UploadedFile;

class DriverController extends Controller
{

    public function index()
    {

        $driverCollection = Driver::latest();

        if (request('search')) {
            $driverCollection = $driverCollection
                ->where('email', 'like', '%' . request('search') . '%')
                ->orWhere('license_no', 'like', '%' . request('search') . '%');
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
        // dd($request->all());
        try {
            $password = $request->password;
            $confirmedPassword  = $request->confirm_password;
            if ($password === $confirmedPassword) {
                $userData = [
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id'  => 2
                ];

                $user = User::create($userData);
                event(new Registered($user));

                $driverData = [
                    'name'    => $request->name,
                    'phone'   => $request->phone,
                    'email'   => $request->email,
                    'user_id' => $user->id,
                    'license_no' => $request->license_no,
                    'picture' => $this->uploadpdf(request()->file('picture')),
                   

                ];

                
                Driver::create($driverData);

                return redirect()->route('drivers.index')->withMessage("Successfully created driver with user");
            } else {
                // dd("Check");
                return redirect()->back()->withErrors("Password didn't match");
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
        $user = User::find($driver->user_id);

        $driver->update([

            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'user_id' => $user->id,
            'license_no' => $request->license_no,
            'picture' => $request->picture

        ]);

        $user->update([

            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => 2

        ]);

        // $driver->uppdate();


        return redirect()->route('drivers.index');
    }

    public function destroy(Driver $driver)
    {
        try {
            $user = User::find($driver->user_id);
            $user->delete();
            unlink(public_path('storage/drivers/' . $driver->picture));
            $driver->delete();
            return redirect()->route('drivers.index')->withMessage('Successfully Deleted!');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function uploadpdf($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = storage_path('/app/public/drivers/');
        $file->move($destinationPath, $fileName);
        return $fileName;
    }

}
