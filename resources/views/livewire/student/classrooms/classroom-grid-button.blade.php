<div>
    <button class="w-full h-full" id="classroom-{{$classroom->id}}" @if ($selected) wire:click="$parent.unsetSelectedClassroom()" @else wire:click="$parent.selectClassroom({{$classroom->id}})" @endif>
        <div class="h-full border
        border-slate-300 
        rounded-md 
        flex 
        flex-wrap 
        justify-center 
        bg-slate-200 
        aria-selected:bg-blue-600
        aria-selected:text-blue-50
        aria-selected:border-blue-700
        text-slate-600 shadow hover:scale-[1.02] 
        hover:bg-slate-300 transition"
        @if ($selected) aria-selected="true" @endif>
            <div class="p-2 flex items-center gap-1" title="9 students">
                <span class="text-3xl">
                    9
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>                    
            </div>
            <div class="p-2 flex items-center">
                <div>
                    <h4 class="text-lg">{{$classroom->name}}</h4>
                    <h5 class="text-sm" title="{{$classroom->strand->name}}">{{$classroom->strand->code.' - '.$classroom->strand->track->code}}</h5>
                </div>
            </div>
        </div>
    </button>

    @script
    <script type="module">
        $('#classroom-{{$classroom->id}}').hide().fadeIn('fast');
    </script>
    @endscript
</div>
