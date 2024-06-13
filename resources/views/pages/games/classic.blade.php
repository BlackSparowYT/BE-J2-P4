@extends('layouts.app')

<!-- Page head -->
@section('head')

<title>Play classic || {{ env('APP_NAME') }}</title>


@endsection

<!-- Page content -->
@section('content')

@php

    if(isset($_COOKIE['wordle_status']) && !empty($_COOKIE['wordle_status'])) {
        $cookie = json_decode($_COOKIE['wordle_status']);

        $status = $cookie->status;
        $tries = $cookie->tries;
        $word = $cookie->word;
    } else {
        $status = "play";
    }

@endphp

<main>
    <section class="vlx-game vlx-game--classic wst--large wsb--medium js-game js-game--classic">
        <div class="container">
            @if ($status == "win" )
                <div class="inner">
                    <div class="wpb-text">
                        <h2>You have won!</h2>
                        <p>Come back tomorrow to play again</p>
                        <p>The word was: <strong>{{ $word }}</strong></p>
                        <p>You guessed it in <strong>{{ $tries }} {{ $tries > 1 ? "tries" : "try" }}</strong></p>
                    </div>
                </div>
            @else
                <div class="inner game d-grid">
                    @for ($i = 1; $i <= 6; $i++)
                        @for ($j = 1; $j <= 5; $j++)
                            <input class="try_{{ $i }} js-try-{{ $i }}" type="text" maxlength="1" disabled/>
                        @endfor
                    @endfor
                </div>

                <div class="inner keyboard">
                </div>

                <script src="/js/classic.js"></script>
            @endif
        </div>
    </section>
</main>


@endsection
