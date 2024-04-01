<div class="mb-10 mt-3 px-1 md:px-5">
    <div class="block mb-8">
        <h3 class="text-2xl">Classrooms</h3>
    </div>

    @if ($levels->count()<1)
    
    <div class="flex items-center justify-center">  
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
          </svg>
        <h1 class="text-2xl">
            No level
        </h1>
    </div>

    @else

    @foreach ($levels as $level)

    <livewire:student.classrooms.level-row :$level :key="$level->id"/>

    @endforeach

    @endif
</div>
