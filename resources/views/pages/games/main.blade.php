@extends('layouts.app')

<!-- Page head -->
@section('head')

<title>Games || {{ env('APP_NAME') }}</title>

@endsection

<!-- Page content -->
@section('content')

<main>
    @include('components.blocks.header-subpage', ['args' => array('text' => '<h1>Games</h1>')])
    @include('components.blocks.text', ['args' => array('text' =>
        '<p>The games we offer are as follows:</p>
        <ul>
            <li>Wordle (the classic word game)</li>
            <li>Wordle Long (A longer version of the classic wordle game where we use 7 letters and 7 guesses)</li>
            <li>Wordle Short (A shorter version of the classic wordle game where we use 3 letters and 3 guesses)</li>
            <li>Wordle MP Versus (Compete against another player in wordle who can guess the word the fastest)</li>
            <li>Wordle MP Co-op (Work together with another player to guess the word)</li>
        </ul>
        <p>
            <br>
            All multiplayer games are possible to play in short, normal and long mode, Besides that you can also choose your own length and amount of guesses.
            <br>
            You can join any game multiplayer as a guest but to make a multiplayer game you need to have an account!
        </p>'
    )])
</main>

@endsection
