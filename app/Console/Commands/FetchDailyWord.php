<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class FetchDailyWord extends Command
{
    protected $signature = 'word:fetch-daily';
    protected $description = 'Get todays word';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $latestWord = DB::table('daily_word')->orderBy('id', 'desc')->first();

        if (strtotime($latestWord->created_at) < strtotime('today')) {
            Artisan::call('word:update-daily');
            $latestWord = DB::table('daily_word')->orderBy('id', 'desc')->first();
        }


        $this->info($latestWord->word);
    }
}
