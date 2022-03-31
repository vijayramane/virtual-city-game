<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/game-play', [GamePlayController::class, 'index']);
Route::post('/game-play', [GamePlayController::class, 'store']);
Route::get('/game-play/{id}', [GamePlayController::class, 'show']);
Route::put('/game-play/{id}', [GamePlayController::class, 'update']);
Route::delete('/game-play/{id}', [GamePlayController::class, 'destroy']);