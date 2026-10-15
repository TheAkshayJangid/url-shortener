@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">URL Shortner</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-bold' : '' }}"
                    href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="nav-link {{ request()->routeIs('admin.company*') ? 'active fw-bold' : '' }}"
                    href="{{ route('admin.company') }}">Company</a>
                <a class="nav-link {{ request()->routeIs('admin.invite*') ? 'active fw-bold' : '' }}"
                    href="{{ route('admin.invite') }}">Invite Member</a>
                <a class="nav-link {{ request()->routeIs('admin.urls*') ? 'active fw-bold' : '' }}"
                    href="{{ route('admin.urls') }}">Short URLs</a>
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
