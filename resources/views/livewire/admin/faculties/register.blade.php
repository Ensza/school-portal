<div class="">

    <h1 class="text-lg mb-3">
        <a href="/admin/faculties" class="hover:text-blue-500" wire:navigate>
            Faculties
        </a>
        <span class="mx-1">/</span>
        <a href="/admin/faculties/register" class="text-blue-400 hover:text-blue-500" wire:navigate>
            Register
        </a>
    </h1>

    <div class="block rounded bg-white p-2 shadow">
    </div>
    
    @script
    <script type="module">
        $("#faculties-register-link").attr('aria-selected', true);
    </script>
    @endscript
</div>
