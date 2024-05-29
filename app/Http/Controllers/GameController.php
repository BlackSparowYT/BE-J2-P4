<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function classic() {
        return view('pages.games.classic');
    }

    public function long() {
        return view('pages.games.long');
    }

    public function short() {
        return view('pages.games.short');
    }

}
