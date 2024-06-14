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

        $word = $this->getTodaysWord();

        if ($pos == null) {
            return  response()->json([
                "result" => str_contains($word, $letter),
            ], 200);
        } else if ($pos > 0 && $pos < 6) {
            $word_letters = str_split($word);
            foreach ($word_letters as $key => $value) {
                if ($value == $letter && $key == $pos - 1) {
                    return response()->json([
                        "result" => true,
                    ], 200);
                }
            }
            return response()->json([
                "result" => false,
            ], 200);
        } else {
            return response()->json([
                "error" => "Invalid position",
            ], 400);
        }
    }
}
