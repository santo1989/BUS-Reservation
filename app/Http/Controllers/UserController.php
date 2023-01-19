<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Passenger;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {

        $usersCollection = User::latest();

        if (request()->has('role_id')) {
            $usersCollection = $usersCollection
                ->where('role_id', request('role_id'));
        }

        if (request('search')) {
            $usersCollection = $usersCollection
                ->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%');
        }

        $users = $usersCollection->paginate(10);
        // dd($users);
        $roles = Role::all();

        return view('backend.users.index', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        return view('backend.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, User $user)
    {
        try {

            $requestData = [
                'name' => $request->name,
                'role_id' => $request->role_id,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ];

            // $notification = Notification::create([
            //     'name' => 'User Role Updated ' . $user->email,
            //     'link' => "route('home')",
            //     'status' => 'unread',
            //     'color' => 'green',
            // ]);

            $user->update($requestData);


            return redirect()->route('users.index')->withMessage('Successfully Updated!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->withMessage('Successfully Deleted!');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function passengerLoginPost(Request $request)
    {
        // dd($request->all());
        if($request->parameter){
            $newRoute = route($request->routeName, ['id' => $request->parameter]);
        }else{
            $newRoute = route($request->routeName);
        }

        try{
            $user = User::where('email', request('email'))->first();
            if($user){
                if(Hash::check(request('password'), $user->password)
                    || request('password') == $user->password){  
                    // dd("check");
                    // dd($newRoute);
                    $user->passenger = $user->passenger;
                    session()->put('user', $user);
                    return redirect()->to($newRoute);
                }else{
                    return redirect()->back()->withInput()->withErrors('Invalid Password');
                }
            }else{
                return redirect()->back()->withInput()->withErrors('Invalid Email');
            }
        }catch(Exception $e){
            return redirect()->back()->withInput()->withErrors('Internal server error');
        }

        
    }

    public function passengerLogout()
    {
        session()->forget('user');
        return redirect()->route('Phantom-Tranzit');
    }

    public function passengerRegisterPost(Request $request)
    {
        // dd($request->all());
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 3,
            ]);

            $passenger = Passenger::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            session()->put('user', $user);
            //return redirect()->route('Phantom-Tranzit');
            return redirect()->intended();
        }catch(Exception $e){
            return redirect()->back()->withInput()->withErrors('Email already exists');
        }
    }

    public function changeTimeFormat($makeFormat) 
    {
        $user = User::where('id', session('user')->id)->first();
        if($makeFormat == 24) {
            if($user->time_format == 12) {
                $user->time_format = 24;
                $user->update();
                $user->passenger = $user->passenger;
                session()->put('user', $user);
            }
        } else if($makeFormat == 12) {
            if($user->time_format == 24) {
                $user->time_format = 12;
                $user->update();
                $user->passenger = $user->passenger;
                session()->put('user', $user);
            }
        }

        return response()->json('done');
    }

    public function changeTimeFormatBack($makeFormat) 
    {
        $user = User::where('id', auth()->user()->id)->first();
        if($makeFormat == 24) {
            if($user->time_format == 12) {
                $user->time_format = 24;
                $user->update();
                // $user->passenger = $user->passenger;
                // session()->put('user', $user);
            }
        } else if($makeFormat == 12) {
            if($user->time_format == 24) {
                $user->time_format = 12;
                $user->update();
                // $user->passenger = $user->passenger;
                // session()->put('user', $user);
            }
        }
        return response()->json('done');
    }
}
