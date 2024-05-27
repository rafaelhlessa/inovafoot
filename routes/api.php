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
Route::get('teams/{team}/teams', [TeamController::class, 'show'])->name('teams.show');

Route::apiResource('players', PlayerController::class);

Route::apiResource('championship', ChampionshipController::class);



Route::get('championship/{championship}/teams', [ChampionshipController::class, 'teams']);

Route::get('championship/{championship}/players', [ChampionshipController::class, 'players']);

Route::get('championship/{championship}/managers', [ChampionshipController::class, 'managers']);


