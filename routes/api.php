<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ChampionshipController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('managers', ManagerController::class);
Route::apiResource('teams', TeamController::class);
Route::apiResource('players', PlayerController::class);
Route::apiResource('championship', ChampionshipController::class);
