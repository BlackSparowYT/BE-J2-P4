@extends('layouts.app')

@section('show-nav', 'false')

<!-- Page head -->
@section('head')

<title>Edit menu || {{ env('APP_NAME') }}</title>

<link rel="stylesheet" href="/css/datatables.css?v=1.13.7" />
<script src="/js/datatables.js?v=1.13.7"></script>

@endsection

<!-- Page content -->
@section('content')

    <main class="page page--account view view--menu">
        @include('components.account.sidebar', ['page' => 'menu'])
        <div class="content">
            <div class="btn-group">
                <a class="btn btn--primary btn--small" href="{{ route('dashboard.menu') }}"><i class="da-icon da-icon--arrow-left da-icon--small"></i>Go back</a>
                @if($mode == "edit")
                    <a class="btn btn--primary btn--small btn--danger" href="{{ route('dashboard.menu.trash', $item->slug) }}"><i class="da-icon da-icon--trash da-icon--small"></i>Delete</a>
                @endif
            </div>

            @if($mode == 'add')
                @include('components.forms.menu.create')
            @elseif($mode == 'edit')
                @include('components.forms.menu.edit', ['item' => $item])
            @elseif($mode == 'delete')
                @include('components.forms.menu.trash', ['item' => $item]   )
            @endif

        </div>
    </main>

@endsection
