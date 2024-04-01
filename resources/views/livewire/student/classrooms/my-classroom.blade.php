<div>
    <h1 class="text-lg mb-3">My classroom</h1>

    <div class="shadow p-1 mb-2 rounded bg-white">
        @if (!$profile->classroom_id)

        <div class="flex gap-2 items-center justify-center py-4">
            <div class="inline-flex items-center text-end">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                  </svg>
            </div>
            <div class="flex flex-col items-center">
                <h2 class="text-lg w-full">You are currently not enrolled</h2>
                <h4 class="w-full">Go to <a wire:navigate href="/student/classrooms" class="text-blue-600">classrooms</a> and enroll to your designated classroom</h4>
            </div>
        </div>

        @else

        <div class="flex gap-2 items-center justify-center py-4 rounded bg-yellow-50 mb-1 border border-yellow-400 px-4 text-yellow-600">
            <div class="inline-flex items-center text-end">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                  </svg>
            </div>
            <div class="flex flex-col items-center">
                <h2 class="text-lg w-full">You are not enrolled in this classroom yet, please wait for the classroom adviser to accept you</h2>
            </div>
        </div>

        <div class="bg-slate-500 rounded p-2">
            <livewire:student.classrooms.classroom :enable_close_button="false" :classroom="$profile->classroom" />
        </div>

        @endif

    </div>
    
    @script
    <script type="module">
        $("#my-classroom-link").attr('aria-selected', true);
    </script>
    @endscript
</div>
