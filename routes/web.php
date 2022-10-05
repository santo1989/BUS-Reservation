<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\ContractMessageController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\frontend\HomePageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

//frontend

Route::get('/', [HomePageController::class, 'index'])->name('Phantom-Tranzit');
Route::get('/contactUs', [HomePageController::class, 'contactUS'])->name('contactUS');
// Route::get('/trip', [HomePageController::class, 'trip'])->name('trip');
Route::get('/trip/{id}', [HomePageController::class, 'trip'])->name('trip');
Route::get('/fleets', [HomePageController::class, 'fleets'])->name('fleets');
Route::get('/fleet-details/{id}', [HomePageController::class, 'fleet_details'])->name('fleet_details');
Route::get('/transport', [HomePageController::class, 'transport'])->name('transport');
Route::get('/transport-details', [HomePageController::class, 'transport_details'])->name('transport_details');
Route::post('/trip/newBooking/', [BookingController::class, 'newBooking'])->name('newBooking');





Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        return view('backend.home');
    })->name('home');

    //role
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');


    //user
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    //driver
    Route::resource('/drivers', DriverController::class);

    //passenger
    Route::resource('/passengers', PassengerController::class);
    Route::get('/checkPassengers', [PassengerController::class, 'checkPassengers'])->name('driver.trip.passenger');
    Route::get('/passengerList/{trip_id}', [PassengerController::class, 'passengerList'])->name('driver.trip.passengerList');

    //event    
    // Route::get('/events/trashed-events', [EventController::class, 'trash'])->name('events.trashed');
    // Route::get('/events/trashed-events/{events}/restore', [EventController::class, 'restore'])->name('events.restore');
    // Route::delete('/events/trashed-events/{events}/delete', [EventController::class, 'delete'])->name('events.delete');

    // Route::get('/events', [EventController::class, 'index'])->name('events.index');
    // Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    // Route::post('/events', [EventController::class, 'store'])->name('events.store');
    // Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    // Route::get('/events/edit/{event_id}', [EventController::class, 'edit'])->name('events.edit');
    // Route::put('/events/{event_id}', [EventController::class, 'update'])->name('events.update');
    // Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    //events
    Route::controller(EventController::class)->prefix('events')->group(function () {
        Route::get('/events/trashed-events', 'trash')->name('events.trashed');
        Route::get('/events/trashed-events/{events}/restore', 'restore')->name('events.restore');
        Route::delete('/events/trashed-events/delete/{events}', 'delete')->name('events.delete');

        Route::get('/', 'index')->name('events.index');
        Route::get('/create', 'create')->name('events.create');
        Route::post('/store', 'store')->name('events.store');
        Route::get('/edit/{single_event}', 'edit')->name('events.edit');
        Route::put('/update/{update_event}', 'update')->name('events.update');
        Route::get('/show/{event_show}', 'show')->name('events.show');
        Route::delete('/destroy/{event_id}', 'destroy')->name('events.destroy');
    });

    //buses
    Route::controller(BusController::class)->prefix('buses')->group(function () {
        Route::get('/', 'index')->name('buses.index');
        Route::get('/create', 'create')->name('buses.create');
        Route::post('/store', 'store')->name('buses.store');
        Route::get('/edit/{single_buse}', 'edit')->name('buses.edit');
        Route::post('/update/{single_buse}', 'update')->name('buses.update');
        Route::delete('/delete/{buse}', 'destroy')->name('buses.destroy');
        Route::get('/show/{show_buse}', 'show')->name('buses.show');
    });

    //trips
    Route::controller(TripController::class)->prefix('trips')->group(function () {
        Route::get('/', 'index')->name('trips.index');
        Route::get('/create', 'create')->name('trips.create');
        Route::post('/store', 'store')->name('trips.store');
        Route::get('/edit/{trip_id}', 'edit')->name('trips.edit');
        Route::post('/update/{trip_id}', 'update')->name('trips.update');
        Route::delete('/delete/{trip_id}', 'delete')->name('trips.destroy');
    });

    //bookings
    Route::controller(BookingController::class)->prefix('bookings')->group(function () {
        Route::get('/', 'index')->name('bookings.index');
        Route::get('/create', 'create')->name('bookings.create');
        Route::post('/store', 'store')->name('bookings.store');
        Route::get('/edit/{booking_id}', 'edit')->name('bookings.edit');
        Route::put('/update/{booking_id}', 'update')->name('bookings.update');
        Route::delete('/delete/{booking_id}', 'delete')->name('bookings.destroy');
    });
});



Route::get('/contract-message', [ContractMessageController::class, 'index'])->name('contract_message.index');

Route::get('/contract-message/create', [ContractMessageController::class, 'create'])->name('contract_message.create');

Route::post('/contract-message', [ContractMessageController::class, 'store'])->name('contract_message.store');

Route::get('/contract-message/{message}', [ContractMessageController::class, 'show'])->name('contract_message.show');

Route::get('/contract-message/{message}/edit', [ContractMessageController::class, 'edit'])->name('contract_message.edit');

Route::put('/contract-message/{message}', [ContractMessageController::class, 'update'])->name('contract_message.update');

Route::delete('/contract-message/{message}', [ContractMessageController::class, 'destroy'])->name('contract_message.destroy');


Route::get('/notification/{message}/{notification}', [NotificationController::class, 'showForUpdating'])->name("/message.show");

Route::get('/get-bookings/{trip_id}', [BookingController::class, 'getBookings']);

Route::get('/get-trips/{event_id}', [BookingController::class, 'getTrips']);

Route::get('/get-stoppages/{trip_id}', [BookingController::class, 'getStoppages']);

Route::get('/get-available-seat/{trip_id}', [BookingController::class, 'getAvailableSeat']);

// Route::get('/setplane', function () {
//     return view('backend.setplane');
// });

// Route::get('/Bussetplane', function () {
//     return view('backend.Bussetplane');
// });

Route::get('/driver_passenger_index', function () {
    return view('backend.passenger.driver_passenger_index');
});

require __DIR__ . '/auth.php';
