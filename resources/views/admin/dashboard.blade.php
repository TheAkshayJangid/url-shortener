@extends('layouts.admin')

@section('panel')
    <h5 class="mb-3">Welcome, {{ auth()->user()->name }} — {{ $company->name }}</h5>

    @include('partials.counters', [
        'items' => [
            ['label' => 'Admins', 'value' => $adminsCount, 'bg' => 'primary'],
            ['label' => 'Members', 'value' => $membersCount, 'bg' => 'info'],
            ['label' => 'Short URLs', 'value' => $urlsCount, 'bg' => 'dark'],
            ['label' => 'URL Hits', 'value' => $hitsCount, 'bg' => 'success'],
        ],
        'col' => 3,
    ])
@endsection
