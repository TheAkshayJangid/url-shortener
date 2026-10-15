@extends('layouts.superadmin')

@section('panel')
    @include('partials.counters', [
        'items' => [
            ['label' => 'Companies', 'value' => $companiesCount, 'bg' => 'primary'],
            ['label' => 'Admins', 'value' => $adminsCount, 'bg' => 'info'],
            ['label' => 'Members', 'value' => $membersCount, 'bg' => 'secondary'],
            ['label' => 'Short URLs', 'value' => $urlsCount, 'bg' => 'dark'],
        ],
        'col' => 3,
    ])

    @include('partials.counters', [
        'items' => [['label' => 'Total URL Hits', 'value' => $hitsCount, 'bg' => 'success']],
        'col' => 12,
    ])
@endsection
