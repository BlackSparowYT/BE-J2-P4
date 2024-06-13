<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateDailyWord extends Command
{
    protected $signature = 'word:update-daily';
    protected $description = 'Fetch a random word from Wordnik and insert it into the daily_word table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $apiUrl = "https://api.wordnik.com/v4/words.json/randomWord?hasDictionaryDef=true&includePartOfSpeech=noun%2Cverb%2Cadjective&maxCorpusCount=-1&minDictionaryCount=1&maxDictionaryCount=-1&minLength=5&maxLength=5&api_key=".env('WORDNIK_API_KEY');
        $response = file_get_contents($apiUrl);
        $word = json_decode($response)->word;

        DB::table('daily_word')->insert([
            'word' => $word,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
