@extends('layouts.admin')

@section('panel')
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-semibold">Generate Short URL</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.urls.store') }}" class="row g-2">
                @csrf
                <div class="col-md-9">
                    <input type="url" name="long_url" value="{{ old('long_url') }}"
                        class="form-control @error('long_url') is-invalid @enderror"
                        placeholder="https://example.com/long/path" required>
                    @error('long_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100">Generate</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header fw-semibold">Company Short URLs</div>
        <div class="card-body">
            <table class="table table-bordered" id="urlsTable">
                <thead>
                    <tr>
                        <th>Short URL</th>
                        <th>Long URL</th>
                        <th>Hits</th>
                        <th>Created By</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($urls as $u)
                        <tr>
                            <td><a href="{{ $u->short_link }}" target="_blank">{{ $u->short_link }}</a></td>
                            <td class="text-truncate" style="max-width:320px;">{{ $u->long_url }}</td>
                            <td>{{ $u->hits }}</td>
                            <td>{{ $u->user->name ?? '-' }}</td>
                            <td data-order="{{ $u->created_at->timestamp }}">{{ $u->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        initDataTable('#urlsTable');
    </script>
@endpush
