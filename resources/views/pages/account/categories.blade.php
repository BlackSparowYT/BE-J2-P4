@extends('layouts.app')

@section('show-nav', 'false')

<!-- Page head -->
@section('head')

<title>Categories || {{ env('APP_NAME') }}</title>

<link rel="stylesheet" href="/css/datatables.css?v=1.13.7" />
<script src="/js/datatables.js?v=1.13.7"></script>

@endsection

<!-- Page content -->
@section('content')

    <main class="page page--account">
        @include('components.account.sidebar', ['page' => 'category'])
        <div class="content">
            <div class="btn-group">
                <a class="btn btn--primary btn--small" href="{{ route('dashboard.category.add') }}"><i class="da-icon da-icon--plus da-icon--small"></i>Add project</a>
            </div>
            <table id="projectsTable" class="display" data-page-length='20'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Category::all() as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->slug }}</td>
                            <td class="actions"><a href="{{ route('dashboard.category.edit', $category->slug) }}" class="btn btn--link"><i class="da-icon da-icon--pen-to-square da-icon--small"></i> Edit</a></td>
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
