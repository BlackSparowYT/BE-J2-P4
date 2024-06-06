@extends('layouts.app')

@section('show-nav', 'false')

<!-- Page head -->
@section('head')

<title>Edit categories || {{ env('APP_NAME') }}</title>

<link rel="stylesheet" href="/css/datatables.css?v=1.13.7" />
<script src="/js/datatables.js?v=1.13.7"></script>

@endsection

<!-- Page content -->
@section('content')

    <main class="page page--account view view--menu">
        @include('components.account.sidebar', ['page' => 'category'])
        <div class="content">
            <div class="btn-group">
                <a class="btn btn--primary btn--small" href="{{ route('dashboard.category') }}"><i class="da-icon da-icon--arrow-left da-icon--small"></i>Go back</a>
                @if($mode == "edit")
                    <a class="btn btn--primary btn--small btn--danger" href="{{ route('dashboard.category.trash', $category->slug) }}"><i class="da-icon da-icon--trash da-icon--small"></i>Delete</a>
                @endif
            </div>

            @if($mode == 'add')
                @include('components.forms.categories.create')
            @elseif($mode == 'edit')
                @include('components.forms.categories.edit', ['category' => $category])
            @elseif($mode == 'delete')
                @include('components.forms.categories.trash', ['category' => $category]   )
            @endif

        </div>
    </main>

@endsection
