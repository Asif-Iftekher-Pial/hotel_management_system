<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\EmployeeController;
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



// backend

Route::group(['prefix' => 'app'], function () {
    // Auth
    Route::get('/login', [AuthController::class, 'loginIndex'])->name('loginIndex');
    Route::post('/loginapp', [AuthController::class, 'doLogin'])->name('doLogin');
    

    Route::group(['middleware'=>'employee'],function(){
        
    Route::get('/', [AuthController::class, 'home'])->name('home');

    // Room
    Route::resource('/room', RoomController::class);
    Route::post('/room/status', [RoomController::class, 'roomstatus'])->name('rStatus');
    Route::post('/room/availability', [RoomController::class, 'availabilitystatus'])->name('availability');

    // Category
    Route::resource('/category', CategoryController::class);
    // Employee
    Route::resource('/employee', EmployeeController::class);
    Route::get('/search/employee', [EmployeeController::class, 'filterEmployee'])->name('filterEmployee');
    });


});
