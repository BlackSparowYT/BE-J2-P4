<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/api/wordnik-api-key', [ApiController::class, "getWordnikApiKey"]);
Route::get('/api/wordle-word', [ApiController::class, "getTodaysWord"]);
Route::get('/api/check-letter/{letter}', [ApiController::class, "checkLetterInWord"]);
Route::get('/api/check-letter/{letter}/{pos}', [ApiController::class, "checkLetterInWord"]);
