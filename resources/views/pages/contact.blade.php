@extends('layouts.app')

<!-- Page head -->
@section('head')

<title>Contact || {{ env('APP_NAME') }}</title>

@endsection

<!-- Page content -->
@section('content')

<main>
    <section class="block block--header block--header-subpage">
        <div class="container">
            <div class="text">
                <h1>Contact</h1>
            </div>
        </div>
    </section>
    <section class="block block--form">
        <div class="container">
            @include('components.forms.contact.create')
        </div>
    </section>
</main>

@endsection
