@extends('layouts.app')

<!-- Page head -->
@section('head')

<title>Home || {{ env('APP_NAME') }}</title>

@endsection

<!-- Page content -->
@section('content')

<main>
    <section class="block block--header block--header-home">
        <div class="container">
            <div class="text">
                <h1>{{ env('APP_NAME') }}</h1>
            </div>
        </div>
    </section>
</main>

@endsection
