<div>
    @script
    <script type="module">
        $("#curricula-and-subjects-link").attr('aria-selected', true);
    </script>
    @endscript

    <h1 class="text-lg mb-3">Curricula and Subjects</h1>

    <div class="w-full shadow rounded p-2 bg-white">
        <livewire:admin.curricula-and-subjects.create-curriculum/>
        <livewire:admin.curricula-and-subjects.curricula/>
    </div>
</div>
