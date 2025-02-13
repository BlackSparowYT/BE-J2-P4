@extends('layouts.app')

@section('show-nav', 'false')

<!-- Page head -->
@section('head')

<title>Menu || {{ env('APP_NAME') }}</title>

<link rel="stylesheet" href="/css/datatables.css?v=1.13.7" />
<script src="/js/datatables.js?v=1.13.7"></script>

@endsection

<!-- Page content -->
@section('content')

    <main class="page page--account">
        @include('components.account.sidebar', ['page' => 'menu'])
        <div class="content">
            <div class="btn-group">
                <a class="btn btn--primary btn--small" href="{{ route('dashboard.menu.create') }}"><i class="da-icon da-icon--plus da-icon--small"></i>Add project</a>
            </div>
            <table id="projectsTable" class="display" data-page-length='20'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item name</th>
                        <th>Excerpt</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Item::all() as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->excerpt }}</td>
                            <td class="actions"><a href="{{ route('dashboard.menu.edit', $item->slug) }}" class="btn btn--link"><i class="da-icon da-icon--pen-to-square da-icon--small"></i> Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <script>
                let table = new DataTable('#projectsTable', {
                    "lengthMenu": [20],
                });
            </script>
        </div>
    </main>

@endsection
