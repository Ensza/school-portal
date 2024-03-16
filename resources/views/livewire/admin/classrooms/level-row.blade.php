<div class="block border rounded-md mb-10 overflow-clip relative bg-slate-500 p-2">
    <div class="text-slate-50">
        <h2 class="text-2xl py-2">{{$level->name}}</h2>
    </div>
    <div class="shadow-inner bg-slate-50 rounded">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 p-4 py-20">
            @foreach ($level->classrooms as $classroom)

            <livewire:admin.classrooms.classroom-grid-button :$classroom 
            :selected="$selected_classroom && $selected_classroom->id == $classroom->id" 
            {{-- if selected, force re-render a button by changing its key --}}
            :key="$selected_classroom && $selected_classroom->id == $classroom->id ? $classroom->id.'-selected' : $classroom->id"/>

            @endforeach

            <div>
                <button class="w-full h-full" wire:click="openAddClassroom()">
                    <div class="h-full border-2 border-dashed rounded-md flex flex-wrap justify-center text-slate-400 py-2">
                        <div class="p-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                              </svg>                                            
                        </div>
                        <div class="p-2 flex items-center">
                            <h4 class="text-lg">Add classroom</h4>
                        </div>
                    </div>
                </button>

            </div>

        </div>

        {{-- loader div --}}
        <x-loader/>
    </div>
    

    <div class="block" id="classroom-panel">
            
        @if ($creating_classroom)

        <livewire:admin.classrooms.add_classroom :$level @classroom-created="$refresh"/>

        @endif



        @if($selected_classroom)

        <livewire:admin.classrooms.classroom :classroom="$selected_classroom" :key="$selected_classroom->id.'-selected'"/>

        @endif

    </div>
</div>
