<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Ramsey\Uuid\Uuid as UUID;
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





    /// MP


    // Short

    public function sh_mp_vs() {
        return view('pages.games.mp.short.versus');
    }

    public function sh_mp_cp() {
        return view('pages.games.mp.short.coop');
    }

    // Classic

    public function no_mp_vs() {

        if(!auth()->check()) {
            return redirect()->route('login', ["return" => urlencode(route('game.mp.classic.versus'))])->with('error', 'You need to be logged in to start multiplayer games');
        }

        $users[] = [
            auth()->user()->uuid,
            now()->toDateTimeString()
        ];



        // set a new game in the database
        $game = new Game;
        $game->uuid = UUID::uuid4()->toString();
        $game->word = get_random_words(5, 5);
        $game->players = json_encode($users);
        $game->guesses = json_encode([]);
        $game->save();

        return view('pages.games.classic-mp-vs', ['game_id' => $game->uuid, 'status' => 'waiting']);
    }

    public function no_mp_vs_game($game_id) {

        if(!auth()->check()) {
            return redirect()->route('login', ["return" => urlencode(route('game.mp.classic.versus', $game_id))])->with('error', 'You need to be logged in to join multiplayer games');
        }

        $game = Game::where('uuid', $game_id)->first();

        $users = json_decode($game->players);
        $users[] = [
            auth()->user()->uuid,
            now()->toDateTimeString()
        ];

        $game->players = json_encode($users);

        return view('pages.games.classic-mp-vs', ['game_id' => $game_id, 'status' => 'playing', 'game' => $game]);
    }

    public function no_mp_cp() {
        return view('pages.games.mp.classic.coop');
    }

    public function no_mp_cp_game($game_id) {
        return view('pages.games.mp.classic.coop', ['game_id' => $game_id]);
    }








}
