@extends('layouts.admin')

@section('panel')
    <div class="card shadow-sm">
        <div class="card-header fw-semibold">My Company — {{ $company->name }}</div>
        <div class="card-body">
            <table class="table table-bordered" id="usersTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($company->users as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td><span class="badge bg-secondary">{{ $u->role }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        initDataTable('#usersTable');
    </script>
@endpush
