<div class="curriculum" row-id="{{$curriculum->id}}">
    <div class="p-1 rounded-lg bg-slate-200 border relative">
        @if ($editing)

        <div class="mb-2 p-2 flex">
            <div class="grid w-full px-2">
                <input type="text" class="border rounded px-1 bg-slate-50 md:w-1/2 mb-1 aria-[invalid]:bg-red-50 aria-[invalid]:border-red-500" placeholder="Curriculum name here" wire:model="name">
                <select class="border rounded px-1 bg-slate-50 md:w-1/2 aria-[invalid]:bg-red-50 aria-[invalid]:border-red-500" wire:model="strand_id">
                    @foreach ($strands as $strand)
                        <option value="{{$strand->id}}" 
                            @if ($curriculum->strand_id == $strand->id)
                            selected
                            @endif
                        >{{$strand->name}} - {{$strand->code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-nowrap">
                <button class="text-green-500" title="confirm edit" wire:click="edit()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                      </svg>                                                               
                </button>
                <button class="text-red-500 hidden" title="delete" wire:click="delete()" wire:confirm="Are you sure you want to delete curriculum {{$curriculum->name}}?">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                      </svg>                                         
                </button>
                <button class="text-red-500" title="cancel edit" wire:click="$toggle('editing')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                      </svg>                                          
                </button>
            </div>
        </div>

        @else

        <div class="mb-2 p-2 flex">
            <div class="grid w-full">
                <span class="block text-slate-700">{{$curriculum->name}}</span>
                <span class="block text-slate-500 text-sm">{{$curriculum->strand->code}}</span>
            </div>
            <div class="text-nowrap">
                <button class="text-blue-800" title="edit" wire:click="toggleEditing()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                      </svg>                      
                </button>
                <button class="text-red-500" title="delete" wire:click="delete()" wire:confirm="Are you sure you want to delete curriculum {{$curriculum->name}}?">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                      </svg>                                         
                </button>
            </div>
        </div>

        @endif
        
        <div id="subjects-panel" class="border rounded overflow-clip bg-white">
            <div>
                @if ($curriculum->subjects->count()<1)
    
                <div class="text-center text-slate-500 p-4 border-b">
                    <span>This curriculum has no subjects, add a subject now</span>
                </div>
    
                @else
                <div class="p-2 border-b bg-slate-200 text-center font-bold">Subjects</div>
                @foreach ($curriculum->subjects as $subject)
                <livewire:admin.curricula-and-subjects.subject :$subject :key="$subject->id" />
                @endforeach
    
                @endif
            </div>
            <div class="p-2 bg-white border-t">
                <livewire:admin.curricula-and-subjects.create-subject :curriculum_id="$curriculum->id" @subject-created="$refresh"/>
            </div>
        </div>
        {{-- loader div --}}
        <x-loader/>
    </div>
    @script
        <script type="module">
            $('.curriculum[row-id={{$curriculum->id}}]').hide().fadeIn('fast');
        </script>
    @endscript

    @if($deleted)
    @script
    <script type="module">
        $('.curriculum[row-id={{$curriculum->id}}]').fadeOut('fast', function(){
            $(this).hide();
        });
    </script>
    @endscript
    @endif
</div>