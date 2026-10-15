@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('member.dashboard') }}">URL Shortner</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link {{ request()->routeIs('member.dashboard') ? 'active fw-bold' : '' }}"
                    href="{{ route('member.dashboard') }}">Dashboard</a>
                <a class="nav-link {{ request()->routeIs('member.urls*') ? 'active fw-bold' : '' }}"
                    href="{{ route('member.urls') }}">Short URLs</a>
            </div>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>
    <div class="container-fluid py-4">
        @yield('panel')
    </div>
@endsection
