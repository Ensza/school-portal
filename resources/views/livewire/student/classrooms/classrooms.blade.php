<div>
    <h1 class="text-lg mb-3">Classrooms</h1>
    
    <div class="shadow p-1 mb-2 rounded bg-white">
        <livewire:student.classrooms.levels/>
    </div>
    
    @script
    <script type="module">
        $("#classrooms-link").attr('aria-selected', true);
    </script>
    @endscript
</div>
