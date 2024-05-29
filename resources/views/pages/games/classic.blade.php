@extends('layouts.app')

<!-- Page head -->
@section('head')

<title>Play classic || {{ env('APP_NAME') }}</title>

@endsection

<!-- Page content -->
@section('content')

<main>
    <section class="vlx-game vlx-game--classic  wst--large wsb--medium  js-game js-game--classic">
        <div class="container">
            <div class="inner game d-grid">
                <input class="try_1 js-try-1" type="text" maxlength="1" />
                <input class="try_1 js-try-1" type="text" maxlength="1" />
                <input class="try_1 js-try-1" type="text" maxlength="1" />
                <input class="try_1 js-try-1" type="text" maxlength="1" />
                <input class="try_1 js-try-1" type="text" maxlength="1" />

                <input class="try_2 js-try-2" type="text" maxlength="1" />
                <input class="try_2 js-try-2" type="text" maxlength="1" />
                <input class="try_2 js-try-2" type="text" maxlength="1" />
                <input class="try_2 js-try-2" type="text" maxlength="1" />
                <input class="try_2 js-try-2" type="text" maxlength="1" />

                <input class="try_3 js-try-3" type="text" maxlength="1" />
                <input class="try_3 js-try-3" type="text" maxlength="1" />
                <input class="try_3 js-try-3" type="text" maxlength="1" />
                <input class="try_3 js-try-3" type="text" maxlength="1" />
                <input class="try_3 js-try-3" type="text" maxlength="1" />

                <input class="try_4 js-try-4" type="text" maxlength="1" />
                <input class="try_4 js-try-4" type="text" maxlength="1" />
                <input class="try_4 js-try-4" type="text" maxlength="1" />
                <input class="try_4 js-try-4" type="text" maxlength="1" />
                <input class="try_4 js-try-4" type="text" maxlength="1" />

                <input class="try_5 js-try-5" type="text" maxlength="1" />
                <input class="try_5 js-try-5" type="text" maxlength="1" />
                <input class="try_5 js-try-5" type="text" maxlength="1" />
                <input class="try_5 js-try-5" type="text" maxlength="1" />
                <input class="try_5 js-try-5" type="text" maxlength="1" />

                <input class="try_6 js-try-6" type="text" maxlength="1" />
                <input class="try_6 js-try-6" type="text" maxlength="1" />
                <input class="try_6 js-try-6" type="text" maxlength="1" />
                <input class="try_6 js-try-6" type="text" maxlength="1" />
                <input class="try_6 js-try-6" type="text" maxlength="1" />


            </div>
            <div class="inner keyboard">

            </div>
        </div>
    </section>
</main>

<script src="/js/classic.js"></script>

@endsection
