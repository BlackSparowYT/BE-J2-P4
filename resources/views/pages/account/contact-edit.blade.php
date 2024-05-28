@extends('layouts.app')

@section('show-nav', 'false')

<!-- Page head -->
@section('head')

<title>Edit categories || {{ env('APP_NAME') }}</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

@endsection

<!-- Page content -->
@section('content')

    <main class="page page--account view view--menu">
        @include('components.account.sidebar', ['page' => 'contact'])
        <div class="content">
            <div class="btn-group">
                <a class="btn btn--primary btn--small" href="{{ route('dashboard.contact') }}"><i class="da-icon da-icon--arrow-left da-icon--small"></i>Go back</a>
                @if($mode == "view")
                    <a class="btn btn--primary btn--small btn--danger" href="{{ route('contact.trash', $contact->id) }}"><i class="da-icon da-icon--trash da-icon--small"></i>Delete</a>
                @endif
            </div>

            @if($mode == 'delete')
                @include('components.forms.contact.trash', ['contact' => $contact]   )
            @elseif($mode == 'view')
                @include('components.forms.contact.view', ['contact' => $contact]   )
            @endif

        </div>
    </main>

@endsection
