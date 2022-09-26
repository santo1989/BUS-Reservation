<?php

use App\Http\Controllers\DriverRegistrationController;
use App\Http\Controllers\ResultController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/check', function () {
//     return "Hello";
// });
// Route::get('/admin/driver_registration/store/{driver_id}/{passenger_id}/{year}/{driver_year}', [DriverRegistrationController::class, 'store']);
// Route::get('/admin/driver_registration/drivers/{passenger_id}/{year}/{driver_year}', [DriverRegistrationController::class, 'showDrivers']);
