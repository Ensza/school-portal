<div class="">

    <h1 class="text-lg mb-3">Faculties</h1>

    <div class="block rounded bg-white p-2 shadow">
        <a href="/admin/faculties/register" wire:navigate>
            <button class="p-2 rounded bg-blue-500 text-white hover:bg-blue-600 shadow inline-flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Register new faculty
            </button>
        </a>
    </div>
    
    @script
    <script type="module">
        $("#faculties-link").attr('aria-selected', true);
    </script>
    @endscript
</div>
