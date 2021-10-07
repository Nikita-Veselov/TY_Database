<?php

use App\Http\Controllers\ControlledPointController;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\WorkersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontpage');
});

Route::resource('/records', RecordController::class);

Route::resource('/workers', WorkersController::class);

Route::resource('/devices', DevicesController::class);

Route::resource('/controlledPoints', ControlledPointController::class);



