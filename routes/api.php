<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketReservationController;
use App\Http\Controllers\UserController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/events', [UserController::class, 'events']);
        Route::get('/reservations', [UserController::class, 'reservations']);
    });

    Route::apiResource('events', EventController::class)->except(['update', 'destroy']);
    Route::post('/events/{event}/reserve', [TicketReservationController::class, 'store']);
});
