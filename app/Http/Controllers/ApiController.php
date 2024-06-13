<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class ApiController extends Controller
{
    public function getWordnikApiKey()
    {
        return response()->json([
            'wordnik_api_key' => env('WORDNIK_API_KEY'),
        ]);
    }

    public function getTodaysWord() {
        Artisan::call('word:fetch-daily');
        $output = Artisan::output();

        return response()->json([
            "word" => trim($output),
        ]);
    }
}
