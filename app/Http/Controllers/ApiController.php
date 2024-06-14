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

    public function checkLetterInWord($letter, $pos = null) {
        if ($pos == null) {
            //check if letter is in word
        } else if ($pos > 0 && $pos < 6) {
            // check if letter is in right spot
        } else {
            return response()->json([
                "error" => "Invalid position",
            ], 400);
        }
    }
}
