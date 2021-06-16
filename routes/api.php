<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GamesController;
use App\Http\Controllers\Api\FriendsController;
use App\Http\Controllers\Api\TournamentsController;

Route::apiResource('tournaments',TournamentsController::class);
Route::apiResource('games',GamesController::class);
Route::apiResource('friends',FriendsController::class);

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
