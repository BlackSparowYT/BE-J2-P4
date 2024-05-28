@extends('layouts.app')

@section('show-nav', 'false')

<!-- Page head -->
@section('head')

<title>Categories || {{ env('APP_NAME') }}</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

@endsection

<!-- Page content -->
@section('content')

    <main class="page page--account">
        @include('components.account.sidebar', ['page' => 'user'])
        <div class="content">
            <table id="projectsTable" class="display" data-page-length='20'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\User::all() as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->name }}</td>
                            <td class="actions"><a href="{{ route('dashboard.user.edit', $user->id) }}" class="btn btn--link"><i class="da-icon da-icon--pen-to-square da-icon--small"></i> Edit</a></td>
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
