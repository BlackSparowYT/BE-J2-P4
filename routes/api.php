<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/api/wordle-word', [ApiController::class, "getTodaysWord"]);
Route::get('/api/check-guess/{word}', [ApiController::class, "checkGuess"]);
Route::get('/api/end-game/{game_id}', [ApiController::class, "endGame"]);
Route::get('/api/check-guess-for-game/{word}/{game_id}', [ApiController::class, "checkGuessForGame"]);
Route::get('/api/get-cookie/{cookie_name}', [ApiController::class, "getCookie"]);
Route::get('/api/set-cookie/{cookie_name}/{data}', [ApiController::class, "setCookie"]);
