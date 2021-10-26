<?php

use App\Http\Controllers\ControlledPointController;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SignalController;
use App\Http\Controllers\TCController;
use App\Http\Controllers\TYController;
use App\Http\Controllers\WorkersController;
use App\Models\ControlledPoint;
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
    return view('frontpage', ['CP' => ControlledPoint::all()->sortBy('name')]);
});

Route::resource('/records', RecordController::class);
Route::get('/print/{CP}', [RecordController::class, 'print'])->name('print');
Route::get('/searchRec', [RecordController::class, 'search'])->name('searchRec');
Route::get('/openPDF/{record}', [RecordController::class, 'openPDF'])->name('openPDF');

Route::resource('/controlledPoints', ControlledPointController::class);
Route::get('/searchCp', [ControlledPointController::class, 'search'])->name('searchCp');

Route::resource('/workers', WorkersController::class);

Route::resource('/devices', DevicesController::class);

Route::resource('/signals', SignalController::class);
Route::get('/print/{CP}', [SignalController::class, 'print'])->name('print');
