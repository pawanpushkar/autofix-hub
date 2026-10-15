<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RepairQuoteController;
use App\Http\Controllers\RepairQuoteStatusController;
use App\Http\Controllers\RepairRequestController;
use App\Http\Controllers\RepairRequestListController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::view('/', 'repair-request');
    Route::post('/repair-requests', [RepairRequestController::class, 'store']);

    Route::get('/requests', [RepairRequestListController::class, 'index']);

    Route::get('/requests/{repairRequest}/quote', [RepairQuoteController::class, 'create']);
    Route::post('/requests/{repairRequest}/quote', [RepairQuoteController::class, 'store']);

    Route::post('/quotes/{repairQuote}/accept', [RepairQuoteStatusController::class, 'accept']);
    Route::post('/quotes/{repairQuote}/complete', [RepairQuoteStatusController::class, 'complete']);

    Route::post('/logout', [AuthController::class, 'logout']);
});