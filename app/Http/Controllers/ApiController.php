<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Exception;
use Illuminate\Http\Response;

class ApiController extends Controller
{

    public function getTodaysWord($json = true) {
        Artisan::call('word:fetch-daily');
        $output = trim(Artisan::output());

        if ($json) {
            return response()->json([
                "word" => $output,
            ]);
        } else {
            return $output;
        }
    }


    public function getCookie($cookie_name) {
        $cookie = json_decode(request()->cookie($cookie_name));

        if ($cookie) {
            return response()->json($cookie);
        } else {
            return response()->json(null);
        }
    }

    public function setCookie($cookie_name, $data) {
        $data = urldecode($data);

        if (!empty($data) && is_array($data)) {
            $data = json_encode($data);
        }

        $now = time();
        $midnight = strtotime('tomorrow');
        $mins = ($midnight - $now) / 60;

        $response = response()->json([
            "message" => "Cookie has been set"

        ]);

        $response->withCookie(cookie($cookie_name, $data, $mins));

        return $response;
    }




    public function checkGuess($guess) {

        $word = $this->getTodaysWord(false);

        if ($guess == $word) {

            return response()->json([
                "result" => "win",
            ], 200);

        } else {

            $word_letters = str_split($word);
            $guess_letters = str_split($guess);

            if (count($word_letters) != count($guess_letters)) {

                return response()->json([
                    "result" => "invalid",
                    "message" => "Word length does not match.",
                ], 200);

            } else if (!$this->checkValidWord($guess)) {

                return response()->json([
                    "result" => "invalid",
                    "message" => "Invalid word.",
                ], 200);

            }

            for($i = 0; $i <= count($word_letters) -1; $i++) {

                if ($word_letters[$i] == $guess_letters[$i]) {
                    $correct_letters[] = $guess_letters[$i];
                } else if (in_array($guess_letters[$i], $word_letters)) {
                    $present_letters[] = $guess_letters[$i];
                } else {
                    $missing_letters[] = $guess_letters[$i];
                }

            }

            $keyboard = range('a', 'z');
            $keyboard_state = [];

            foreach ($keyboard as $letter) {

                if (!empty($correct_letters) && in_array($letter, $correct_letters)) {
                    $keyboard_state[$letter] = "correct";
                } else if (!empty($present_letters) && in_array($letter, $present_letters)) {
                    $keyboard_state[$letter] = "present";
                } else if (!empty($missing_letters) && in_array($letter, $missing_letters)) {
                    $keyboard_state[$letter] = "absent";
                } else {
                    $keyboard_state[$letter] = "default";
                }

            }

            return response()->json([
                "result" => "valid",
                "keyboard" => $keyboard_state,
            ], 200);

        }
    }
















    public function checkValidWord($word) {
        $apiKey = env('WORDNIK_API_KEY');
        $apiUrl = "https://api.wordnik.com/v4/word.json/{$word}/definitions?api_key={$apiKey}";

        try {
            $response = file_get_contents($apiUrl);
            $definitions = json_decode($response);

            $validWord = false;

            foreach ($definitions as $definition) {
                if ($definition->text != "" && $definition->text != null) {
                    $validWord = true;
                    break;
                }
            }

            return $validWord;
        } catch (Exception $error) {
            return false;
        }
    }
}
