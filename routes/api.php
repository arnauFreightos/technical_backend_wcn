<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//returnn next availables classrooms in current weekend
Route::get('/available_classrooms', 'App\Http\Controllers\ClassroomController@getAvailableClassrooms');

//booking an existing classroom with classroom name, date and time, and amount slots
Route::post('/add_booking', 'App\Http\Controllers\ClassroomController@addBooking');