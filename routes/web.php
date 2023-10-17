<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GameController::class, 'menu']);

Route::get('/game', [GameController::class, 'start']);

Route::get('/game', [GameController::class, 'startSurvive']);

Route::post('/move', [PlayerController::class, 'move']);

Route::post('/battle', [PlayerController::class, 'battle']);
