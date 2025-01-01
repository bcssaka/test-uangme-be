<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvestmentController;

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

// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Investment routes for lenders
Route::middleware(['auth:api', 'checkRole:Lender'])->group(function () {
    Route::post('invest', [InvestmentController::class, 'invest']);
    Route::get('investments/total', [InvestmentController::class, 'getTotalInvestments']);
    Route::get('investments', [InvestmentController::class, 'getInvestments']);
});

// Common routes for all authenticated users
Route::middleware('auth:api')->group(function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout']);
});
