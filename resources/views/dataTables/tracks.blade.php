<div class="container">
    <script>
        var tooltipTriggerList = [];
        var tooltipList;
    </script>
    <div class="card">
        <div class="card-header">Manage Tracks</div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush