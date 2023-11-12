<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PublicController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\User\AuthController;
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

Route::prefix('user')->group(function () {
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('send-otp', [AuthController::class, 'sendOtp']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('profile', [AuthController::class, 'profile']);
        Route::post('update-profile', [AuthController::class, 'updateProfile']);
        Route::get('categories', [PublicController::class, 'categories']);
        Route::get('sub-categories', [PublicController::class, 'subCategories']);
        // Route::get('cart', [PublicController::class, 'cart']);
        // Route::get('reports', [AdminController::class, 'reports'])->name('reports');
        // Route::get('invoices', [AdminController::class, 'invoices'])->name('invoices');
        // Route::get('orders', [AdminController::class, 'orders'])->name('orders');
    });
});