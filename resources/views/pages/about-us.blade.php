@extends('layouts.app')

<!-- Page head -->
@section('head')

<title>Over ons || {{ env('APP_NAME') }}</title>

@endsection

<!-- Page content -->
@section('content')

<main>
    @include('components.blocks.header-subpage', ['args' => array('text' => '<h1>Over ons</h1>')])
    @include('components.blocks.text', ['args' => array(
        'text' => "
        <h2>Wie zijn wij?</h2>
        <p>
            Wij zijn een winkel die eten verkoopt. Wij verkopen eten van hoge kwaliteit en wij zorgen ervoor dat onze klanten tevreden zijn. Wij hebben een groot assortiment aan eten en wij zorgen ervoor dat onze klanten altijd iets lekkers kunnen vinden.
            Het grote voordeel van onze winkel is dat wij een groot assortiment hebben en dat wij altijd verse producten verkopen. Wij zorgen ervoor dat onze klanten altijd de beste producten kunnen kopen en dat zij altijd tevreden zijn.
            Daarnaast werken wij samen met thuisbezorgt waardoor alle onze menu items ook thuisbezorgd kunnen worden in no time!
        </p> "
    )])
</main>

@endsection
