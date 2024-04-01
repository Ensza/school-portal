<div>

    <h1 class="text-lg">Tracks and Strands</h1>
    <div id="tracks" class="transition p-3 shadow-sm rounded bg-white mt-4">
        <livewire:admin.tracks-and-strands.tracks/>
        <livewire:admin.tracks-and-strands.create-track/>
    </div>
    
    @script
    <script type="module">
        $("#tracks-and-strands-link").attr('aria-selected', true);
        initFlowbite();
    </script>
    @endscript
</div>
