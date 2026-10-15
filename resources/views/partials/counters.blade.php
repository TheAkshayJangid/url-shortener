<div class="row g-3 mb-4">
    @foreach ($items as $it)
        <div class="col-md-{{ $col ?? 3 }}">
            <div class="card text-bg-{{ $it['bg'] }} shadow-sm">
                <div class="card-body">
                    <div class="small">{{ $it['label'] }}</div>
                    <h3 class="mb-0">{{ $it['value'] }}</h3>
                </div>
            </div>
        </div>
    @endforeach
</div>
