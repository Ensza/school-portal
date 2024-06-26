<div class="block border rounded-md mb-10 overflow-clip relative bg-slate-500 p-2">
    <div class="text-slate-50">
        <h2 class="text-2xl py-2">{{$level->name}}</h2>
    </div>
    <div class="shadow-inner bg-slate-50 rounded">
        
        <div class="grid w-full p-4">
            <div>
                <label for="sort-classrooms text-sm inline-block">Sort by</label>
                <div class="inline-block">
                    <select name="" id="sort-classrooms" wire:model="sort_by" wire:change="sortClassrooms()"
                    class="text-sm border rounded-full bg-slate-50 px-3 py-1">
                        <option value="id">Id</option>
                        <option value="name">Classroom name</option>
                        <option value="strand">Strand</option>
                    </select>
                </div>
            </div>
        </div>

        @if($sort_by=='strand') 
        
        <div class="block pb-10">
            @foreach ($this->classrooms_by_strand as $k=>$v)

            <div class="border-b mx-4" x-data="{collapse_classroom : true}">
                <div class="py-4">
                    <button class="inline-flex items-center gap-4 strand-collapse" title="collapse" x-on:click="collapse_classroom = !collapse_classroom">
                        <span class="text-lg text-slate-500">{{$k}}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="transition w-4 h-4" :class="collapse_classroom && '-rotate-90'">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                          </svg>                      
                    </button>
                </div>
                
                <div x-show="!collapse_classroom" x-transition
                class="transition grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-10 classrooms-panel">
                    
                    @foreach ($v as $classroom)
    
                    <livewire:admin.classrooms.classroom-grid-button :$classroom 
                    :selected="$selected_classroom && $selected_classroom->id == $classroom->id" 
                    {{-- force re-render a classroom button if updated or selected by updating the key --}}
                    :key="
                    $classroom->id.'-'
                    .$classroom->name.'-'
                    .$classroom->strand->id.'-'
                    .$loop->index
                    .($selected_classroom && $selected_classroom->id == $classroom->id ? '-selected' : '')
                    .'-strand-sorted'"
                    />
        
                    @endforeach
    
                </div>
            </div>

            @endforeach

            <h2 class="text-lg text-green-500 p-4">Add classroom</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 px-4 mb-10">
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
        </div>

        @else

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 px-4 pb-20 aria-hidden:hidden">

            @foreach ($classrooms as $classroom)

            <livewire:admin.classrooms.classroom-grid-button :$classroom 
            :selected="$selected_classroom && $selected_classroom->id == $classroom->id" 
            {{-- force re-render a classroom button if updated or selected by updating the key --}}
            :key="
            $classroom->id.'-'
            .$classroom->name.'-'
            .$classroom->strand->id.'-'
            .$loop->index
            .($selected_classroom && $selected_classroom->id == $classroom->id ? '-selected' : '')"
            />

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

        @endif

        {{-- loader div --}}
        <x-loader/>
    </div>
    

    <div class="block" id="classroom-panel">
            
        @if ($creating_classroom)

        <livewire:admin.classrooms.add_classroom :$level @classroom-created="$refresh"/>

        @endif



        @if($selected_classroom)

        <livewire:admin.classrooms.classroom :classroom="$selected_classroom" :key="$selected_classroom->id.'-selected-'"/>

        @endif

    </div>
    
</div>
