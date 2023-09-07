<?php

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


Auth::routes();

Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('send-otp', [\App\Http\Controllers\AuthController::class, 'sendOtp'])->name('user.sendOtp');
Route::post('verify-otp', [\App\Http\Controllers\AuthController::class, 'verifyOtp'])->name('user.verifyOtp');
Route::get('verify-otp/{mobile}', [\App\Http\Controllers\AuthController::class, 'showVerifyOtp'])->name('user.showVerifyOtp');

Route::middleware(['auth','role:admin|captain'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users',\App\Http\Controllers\UserController::class);
    Route::resource('laundry', \App\Http\Controllers\LaundryController::class)->middleware('role:admin');
    Route::resource('cloths', \App\Http\Controllers\ClothsController::class)->middleware('role:admin');
});


Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\ServicesController::class, 'index'])->name('home');
    Route::get('/request-form', [App\Http\Controllers\ServicesController::class, 'create'])->name('addNewRequest');
});

