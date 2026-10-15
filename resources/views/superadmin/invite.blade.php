@extends('layouts.superadmin')

@section('panel')
    @if (session('wa_link'))
        <div class="alert alert-success d-flex justify-content-between align-items-center">
            <span>Invitation created. Share via WhatsApp:</span>
            <a href="{{ session('wa_link') }}" target="_blank" class="btn btn-success btn-sm">Send on WhatsApp</a>
        </div>
    @endif

    <div class="card shadow-sm" style="max-width:720px;">
        <div class="card-header fw-semibold">Invite Client (Admin / Member)</div>
        <div class="card-body">
            <form method="POST" action="{{ route('superadmin.invite.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="">-- Select --</option>
                        <option value="Admin" @selected(old('role') === 'Admin')>Admin</option>
                        <option value="Member" @selected(old('role') === 'Member')>Member</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Company</label>
                    <select name="company_id" class="form-select @error('company_id') is-invalid @enderror" required>
                        <option value="">-- Select --</option>
                        @foreach ($companies as $c)
                            <option value="{{ $c->id }}" @selected(old('company_id') == $c->id)>{{ $c->name }}</option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary">Send Invitation</button>
                <a href="{{ route('superadmin.companies') }}" class="btn btn-outline-secondary">Add company first</a>
            </form>
        </div>
    </div>
@endsection
