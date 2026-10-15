@extends('layouts.member')

@section('panel')
    <h5 class="mb-3">Welcome, {{ auth()->user()->name }}</h5>

    @include('partials.counters', [
        'items' => [
            ['label' => 'My URLs', 'value' => $urlsCount, 'bg' => 'primary'],
            ['label' => 'Total Hits', 'value' => $hitsCount, 'bg' => 'success'],
            ['label' => 'Created Today', 'value' => $todayCount, 'bg' => 'info'],
            ['label' => 'This Month', 'value' => $monthCount, 'bg' => 'dark'],
        ],
        'col' => 3,
    ])
@endsection
