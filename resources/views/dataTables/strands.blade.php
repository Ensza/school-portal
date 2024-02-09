<div class="container">
    <div class="card">
        <div class="card-header">Manage Strands</div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush