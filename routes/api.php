<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VenueController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function (Request $request) {
    return response()->json(['status' => 'true', 'message' => 'API is working fine!']);
});

//Route::get('events', [EventController::class, 'index']);
//Route::post('events', [EventController::class, 'store']);
//Route::get('events/{event}', [EventController::class, 'show']);
//Route::put('events/{event}', [EventController::class, 'update']);
//Route::delete('events/{event}', [EventController::class, 'destroy']);


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
   Route::get('/user', function (Request $request) {
       return $request->user();
   });
   Route::apiResource('events', EventController::class);
   //Route::apiResource('venues', VenueController::class);
});

