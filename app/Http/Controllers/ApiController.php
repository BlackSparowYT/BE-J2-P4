<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Exception;
use Illuminate\Http\Response;
use App\Models\Game; // Add this line to import the 'Game' class

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

            $guess_state = [];

            for($i = 0; $i <= count($word_letters) -1; $i++) {

                if ($word_letters[$i] == $guess_letters[$i]) {
                    $guess_state[] = "correct";
                } else if (in_array($guess_letters[$i], $word_letters)) {
                    $guess_state[] = "present";
                } else {
                    $guess_state[] = "absent";
                }

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
                "guess" => $guess_state,
                "keyboard" => $keyboard_state,
            ], 200);

        }
    }
















    public function checkValidWord($word) {
        $apiKey = env('WORDNIK_API_KEY');
        $apiUrl = "https://api.wordnik.com/v4/word.json/{$word}/definitions?api_key={$apiKey}";


        /**
         * Bug where sometimes it will return invalid word
         * Known words:
         * - FRIES
         * - FLIES
         * - PRESS
         *
         * Solution:
         *  - Make sure the text is not empty AND is set
         *
         * Found by: thornythorn
         */


        try {
            $response = file_get_contents($apiUrl);
            $definitions = json_decode($response);

            $validWord = false;

            foreach ($definitions as $definition) {
                if (isset($definition->text) && !empty($definition->text)) {
                    $validWord = true;
                    break;
                }
            }

            return $validWord;
        } catch (Exception $error) {
            return response()->json([
                "result" => "error",
                "message" => "An error occurred while checking the word.",
            ], 500);
        }
    }
















    // Games
    public function checkGuessForGame($guess, $game_id) {

        $word = $this->getTodaysWord(false);

        $game = Game::where('uuid', $game_id)->first();
        $word = $game->word;

        if ($guess == $word) {

            if ($game->won_user == 0) {
                $game->won_user = auth()->user()->uuid;
                $game->won_time = now()->toDateTimeString();
                $game->save();
            }

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

            $guess_state = [];

            for($i = 0; $i <= count($word_letters) -1; $i++) {

                if ($word_letters[$i] == $guess_letters[$i]) {
                    $guess_state[] = "correct";
                } else if (in_array($guess_letters[$i], $word_letters)) {
                    $guess_state[] = "present";
                } else {
                    $guess_state[] = "absent";
                }

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

            $guesses = json_decode($game->guesses, true);

            if (isset($guesses[auth()->user()->uuid])) {
                $guesses[auth()->user()->uuid][] = $guess;
            } else {
                $guesses[auth()->user()->uuid] = [$guess];
            }

            $game->guesses = json_encode($guesses);
            $game->save();

            return response()->json([
                "result" => "valid",
                "guess" => $guess_state,
                "keyboard" => $keyboard_state,
            ], 200);

        }
    }
}
