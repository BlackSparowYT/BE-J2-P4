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
                <div class="inner">
                    <div class="vlx-game-inputs js-game-inputs d-grid">
                        @for ($i = 1; $i <= 6; $i++)
                            @for ($j = 1; $j <= 5; $j++)
                                <input class="try_{{ $i }} js-try-{{ $i }}" type="text" maxlength="1" disabled/>
                            @endfor
                        @endfor
                    </div>
                </div>

                <div class="vlx-keyboard js-keyboard">
                    <div class="row">
                        <button type="button" data-key="q" aria-label="add q" aria-disabled="false" class="js-key key">q</button>
                        <button type="button" data-key="w" aria-label="add w" aria-disabled="false" class="js-key key">w</button>
                        <button type="button" data-key="e" aria-label="add e" aria-disabled="false" class="js-key key">e</button>
                        <button type="button" data-key="r" aria-label="add r" aria-disabled="false" class="js-key key">r</button>
                        <button type="button" data-key="t" aria-label="add t" aria-disabled="false" class="js-key key">t</button>
                        <button type="button" data-key="y" aria-label="add y" aria-disabled="false" class="js-key key">y</button>
                        <button type="button" data-key="u" aria-label="add u" aria-disabled="false" class="js-key key">u</button>
                        <button type="button" data-key="i" aria-label="add i" aria-disabled="false" class="js-key key">i</button>
                        <button type="button" data-key="o" aria-label="add o" aria-disabled="false" class="js-key key">o</button>
                        <button type="button" data-key="p" aria-label="add p" aria-disabled="false" class="js-key key">p</button>
                    </div>
                    <div class="row">
                        <div data-testid="spacer" class="half"></div>
                        <button type="button" data-key="a" aria-label="add a" aria-disabled="false" class="js-key key">a</button>
                        <button type="button" data-key="s" aria-label="add s" aria-disabled="false" class="js-key key">s</button>
                        <button type="button" data-key="d" aria-label="add d" aria-disabled="false" class="js-key key">d</button>
                        <button type="button" data-key="f" aria-label="add f" aria-disabled="false" class="js-key key">f</button>
                        <button type="button" data-key="g" aria-label="add g" aria-disabled="false" class="js-key key">g</button>
                        <button type="button" data-key="h" aria-label="add h" aria-disabled="false" class="js-key key">h</button>
                        <button type="button" data-key="j" aria-label="add j" aria-disabled="false" class="js-key key">j</button>
                        <button type="button" data-key="k" aria-label="add k" aria-disabled="false" class="js-key key">k</button>
                        <button type="button" data-key="l" aria-label="add l" aria-disabled="false" class="js-key key">l</button>
                        <div data-testid="spacer" class="half"></div>
                    </div>
                    <div class="row">
                        <button type="button" data-key="↵" aria-label="enter" aria-disabled="true" class="key oneAndAHalf">enter</button>
                        <button type="button" data-key="z" aria-label="add z" aria-disabled="false" class="js-key key">z</button>
                        <button type="button" data-key="x" aria-label="add x" aria-disabled="false" class="js-key key">x</button>
                        <button type="button" data-key="c" aria-label="add c" aria-disabled="false" class="js-key key">c</button>
                        <button type="button" data-key="v" aria-label="add v" aria-disabled="false" class="js-key key">v</button>
                        <button type="button" data-key="b" aria-label="add b" aria-disabled="false" class="js-key key">b</button>
                        <button type="button" data-key="n" aria-label="add n" aria-disabled="false" class="js-key key">n</button>
                        <button type="button" data-key="m" aria-label="add m" aria-disabled="false" class="js-key key">m</button>
                        <button type="button" data-key="←" aria-label="backspace" aria-disabled="true" class="key oneAndAHalf">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20" class="game-icon" data-testid="icon-backspace">
                                <path fill="var(--color-tone-1)" d="M22 3H7c-.69 0-1.23.35-1.59.88L0 12l5.41 8.11c.36.53.9.89 1.59.89h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H7.07L2.4 12l4.66-7H22v14zm-11.59-2L14 13.41 17.59 17 19 15.59 15.41 12 19 8.41 17.59 7 14 10.59 10.41 7 9 8.41 12.59 12 9 15.59z" data-darkreader-inline-fill="" style="--darkreader-inline-fill: var(--darkreader-text--color-tone-1, #e8e6e3);"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <script src="/js/classic.js"></script>
            @endif
        </div>
    </section>
</main>


@endsection
