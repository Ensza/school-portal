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
        
        <div class="block mt-4 text-sm">
            {{-- Head --}}
            <div class="grid grid-cols-4 md:grid-cols-5 lg:grid-cols-6 px-4 py-1 rounded-full shadow bg-slate-600 text-white font-bold">
                <div>
                    Advisory
                </div>
                <div class="lg:hidden col-span-2">
                    Name
                </div>
                <div class="hidden lg:block">
                    First Name
                </div>
                <div class="hidden lg:block">
                    Middle Name
                </div>
                <div class="hidden lg:block">
                    Last Name
                </div>
                <div class="hidden md:block">
                    Email
                </div>
                <div class="">
                    Action
                </div>
            </div>

            {{-- body --}}
            <div>

                <div x-data="{expanded : false}" x-on:click="expanded = !expanded"
                class="grid grid-cols-4 md:grid-cols-5 
                lg:grid-cols-6 px-4 py-2 pb-1 rounded-[25px] 
                shadow bg-slate-200 mt-2 cursor-pointer 
                hover:bg-slate-300">
                    <div>
                        Advisory
                    </div>
                    <div class="lg:hidden col-span-2">
                        Name
                    </div>
                    <div class="hidden lg:block">
                        First Name
                    </div>
                    <div class="hidden lg:block">
                        Middle Name
                    </div>
                    <div class="hidden lg:block">
                        Last Name
                    </div>
                    <div class="hidden md:block">
                        Email
                    </div>
                    <div class="">
                        Action
                    </div>

                    {{-- profile --}}
                    <div :aria-expanded="expanded"
                    class="col-start-1 col-span-full max-h-0 aria-expanded:max-h-[1000px] overflow-hidden transition-all">
                        <div x-on:click.stop class="rounded bg-white p-2 shadow-inner mt-2">

                        </div>
                    </div>

                    <div class="col-start-1 col-span-full flex justify-center">
                        <svg 
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                        class="w-4 h-4 aria-expanded:rotate-180 transition" :aria-expanded="expanded">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>                          
                    </div>
                </div>

            </div>

        </div>
    </div>
    
    @script
    <script type="module">
        $("#faculties-link").attr('aria-selected', true);
    </script>
    @endscript
</div>
