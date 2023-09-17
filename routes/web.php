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

Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::post('/request-form', [App\Http\Controllers\ServicesController::class, 'store'])->name('request-form');
Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('send-otp', [\App\Http\Controllers\AuthController::class, 'sendOtp'])->name('user.sendOtp');
Route::post('verify-otp', [\App\Http\Controllers\AuthController::class, 'verifyOtp'])->name('user.verifyOtp');
Route::get('verify-otp/{mobile}', [\App\Http\Controllers\AuthController::class, 'showVerifyOtp'])->name('user.showVerifyOtp');

Route::middleware(['auth','role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('new-request-listing', App\Http\Controllers\ServicesController::class);
    Route::post('assign-request-to-captain', [App\Http\Controllers\ServicesController::class,'assignRequest'])->name('assign.request');
    Route::post('order-detail-chart', [App\Http\Controllers\ServicesController::class,'orderDetailChart'])->name('orders.detail.chart');
    Route::get('types', [App\Http\Controllers\TypesController::class, 'index'])->name('admin.types.index');
    Route::get('invoice', [App\Http\Controllers\OrderController::class,'index'])->name('invoice.index');
    Route::get('reports', [App\Http\Controllers\OrderController::class,'reports'])->name('invoice.reports');
    Route::resource('feedback', App\Http\Controllers\FeedbackController::class);
    Route::resource('users',\App\Http\Controllers\UserController::class);
    Route::resource('category', \App\Http\Controllers\LaundryController::class)->middleware('role:admin');
    Route::resource('sub-category', \App\Http\Controllers\ClothsController::class)->middleware('role:admin');
});

Route::middleware(['auth','role:captain'])->prefix('captain')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'captainHome'])->name('captain.dashboard');
    Route::post('order/payment', [App\Http\Controllers\OrderController::class,'payment'])->name('order.payment');
    Route::resource('cart', App\Http\Controllers\CartController::class);
});

Route::middleware(['auth','role:captain|admin'])->prefix('captain')->group(function () {
    Route::resource('order', App\Http\Controllers\OrderController::class);
    Route::get('/send-sms', [\App\Http\Controllers\SMSController::class, 'sendSMS'])->name('send.sms');
});


Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\ServicesController::class, 'index'])->name('home');
    Route::get('/request-form', [App\Http\Controllers\ServicesController::class, 'create'])->name('addNewRequest');
});

