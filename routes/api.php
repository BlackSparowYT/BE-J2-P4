<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/api/wordnik-api-key', [ApiController::class, "getWordnikApiKey"]);
Route::get('/api/wordle-word', [ApiController::class, "getTodaysWord"]);
