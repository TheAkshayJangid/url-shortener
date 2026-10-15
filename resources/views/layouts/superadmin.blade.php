@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('superadmin.dashboard') }}">URL Shortner</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link {{ request()->routeIs('superadmin.dashboard') ? 'active fw-bold' : '' }}"
                    href="{{ route('superadmin.dashboard') }}">Dashboard</a>
                <a class="nav-link {{ request()->routeIs('superadmin.companies*') ? 'active fw-bold' : '' }}"
                    href="{{ route('superadmin.companies') }}">Companies</a>
                <a class="nav-link {{ request()->routeIs('superadmin.invite*') ? 'active fw-bold' : '' }}"
                    href="{{ route('superadmin.invite') }}">Invite</a>
                <a class="nav-link {{ request()->routeIs('superadmin.urls*') ? 'active fw-bold' : '' }}"
                    href="{{ route('superadmin.urls') }}">Short URLs</a>
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
