@extends('layouts.app')

<!-- Page head -->
@section('head')

<title>Menu || {{ env('APP_NAME') }}</title>

@endsection

<!-- Page content -->
@section('content')

<main>
    <section class="block block--header block--header-subpage">
        <div class="container">
            <div class="text">
                <h1>Menu</h1>
            </div>
        </div>
    </section>
    <section class="block block--items">
        <div class="container">
            <div class="inner d-grid g-20">
                @foreach($items as $item)
                    @include('components.cards.menu-item', ['item' => $item])
                @endforeach
            </div>
        </div>
    </section>
</main>

@endsection
