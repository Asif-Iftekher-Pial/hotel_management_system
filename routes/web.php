<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\RoomController;
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
    return view('backend.layouts.home.home');
});

// backend

// Room
Route::resource('/room',RoomController::class);
Route::post('/room/status',[RoomController::class,'roomstatus'])->name('rStatus');
Route::post('/room/availability',[RoomController::class,'availabilitystatus'])->name('availability');

// Category
Route::resource('/category', CategoryController::class);