<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class GameController extends Controller
{
    public function classic() {
        Artisan::call('word:fetch-daily');
        $word = trim(Artisan::output());
        return view('pages.games.classic', ['word' => $word]);
    }

    public function long() {
        return view('pages.games.long');
    }

    public function short() {
        return view('pages.games.short');
    }

}
