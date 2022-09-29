<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
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
    Route::resource('/passenger', PassengerController::class);

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
        Route::delete('/events/trashed-events/delete/{event_id}', 'delete')->name('events.delete');
        
        Route::get('/', 'index')->name('events.index');
        Route::get('/create', 'create')->name('events.create');
        Route::post('/store', 'store')->name('events.store');
        Route::get('/show/{event_id}', 'show')->name('events.show');
    });

    //buses
    Route::controller(BusController::class)->prefix('buses')->group(function () {
        Route::get('/', 'index')->name('buses.index');
        Route::get('/create', 'create')->name('buses.create');
        Route::post('/store', 'store')->name('buses.store');
        Route::get('/edit/{bus_id}', 'edit')->name('buses.edit');
        Route::post('/update/{bus_id}', 'update')->name('buses.update');
        Route::delete('/delete/{bus_id}', 'delete')->name('buses.destroy');
    });

    //trips
    


    
});

// Route::resource('/message', MessageController::class);
Route::get('/notification/{message}/{notification}', [NotificationController::class, 'showForUpdating'])->name("/message.show");

require __DIR__ . '/auth.php';
