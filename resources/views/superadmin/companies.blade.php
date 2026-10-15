@extends('layouts.superadmin')

@section('panel')
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-semibold">Add Company</div>
        <div class="card-body">
            <form method="POST" action="{{ route('superadmin.companies.store') }}" class="row g-2">
                @csrf
                <div class="col-md-9">
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Company name (unique)"
                        required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100">Add Company</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header fw-semibold">All Companies</div>
        <div class="card-body">
            <table class="table table-bordered" id="companiesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Users</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->users_count }}</td>
                            <td data-order="{{ $c->created_at->timestamp }}">{{ $c->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        initDataTable('#companiesTable');
    </script>
@endpush
