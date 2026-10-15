@extends('layouts.superadmin')

@section('panel')
    <div class="card shadow-sm">
        <div class="card-header fw-semibold">All Short URLs</div>
        <div class="card-body">
            <table class="table table-bordered" id="urlsTable">
                <thead>
                    <tr>
                        <th>Short URL</th>
                        <th>Long URL</th>
                        <th>Hits</th>
                        <th>Created By</th>
                        <th>Company</th>
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
                            <td>{{ $u->company->name ?? '-' }}</td>
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
