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
        $word = get_random_words(5, 5);

        DB::table('daily_word')->insert([
            'word' => $word,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
