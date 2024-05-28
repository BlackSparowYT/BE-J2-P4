@extends('layouts.app')

<!-- Page head -->
@section('head')

<title>Menu Item || {{ env('APP_NAME') }}</title>

@endsection

<!-- Page content -->
@section('content')

<main>
    <section class="block block--header block--header-subpage">
        <div class="container">
            <div class="text">
                <h1>{{ $item['title'] }}</h1>
            </div>
        </div>
    </section>
    <section class="block block--text">
        <div class="container">
            <div class="text">
                <p>{{ $item['content'] }}</p>
            </div>
        </div>
    </section>
</main>

@endsection
