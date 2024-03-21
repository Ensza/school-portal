<div class="w-full top-0 left-0 z-10 overflow-auto py-4">
    
    <div class="w-full lg:mx-auto rounded p-2 relative min-w-[300px]">
        <button class="absolute top-0 right-0 text-white me-1 mt-1" wire:click="$parent.unsetSelectedClassroom()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>                  
        </button>

        <h2 class="text-2xl mb-2 text-white">{{$classroom->name}}</h2>
        <div class="lg:inline-flex gap-2 w-full">
            <div class="w-full mb-2 text-white">
                
                <div class="flex flex-col">
                    <div class="grid grid-cols-12 gap-2 mb-2">
                        <label class="col-span-4 text-sm">Classroom name <span class="text-nowrap">(Section name)</span></label>
                        <div class="col-span-8">
                            <input type="text" class="w-full border rounded p-1 text-slate-600 outline-slate-600
                            aria-[invalid]:bg-red-50
                            aria-[invalid]:border-red-500
                            aria-[invalid]:outline-red-500"
        
                            @error('name') aria-invalid="true" @enderror
                            placeholder="Must not be empty"
                            wire:model="name"
                            @if(!$editing) readonly @endif>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-2 mb-2">
                        <label class="col-span-4 text-sm">Strand</label>
                        <div class="col-span-8">
                            <select type="text" class="w-full border rounded p-1 text-slate-600 outline-slate-600
                            aria-[invalid]:bg-red-50
                            aria-[invalid]:border-red-500
                            aria-[invalid]:outline-red-500"
        
                            @error('strand_id') aria-invalid="true" @enderror
                            wire:model="strand_id"
                            @if(!$editing) disabled @endif>
                                @foreach ($strands as $strand)
                                    <option value="{{$strand->id}}">{{$strand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-12 gap-2 mb-2">
                        <label class="col-span-4 text-sm">Adviser</label>
                        <div class="col-span-8">
                            <select type="text" class="w-full border rounded p-1 text-slate-600 outline-slate-600
                            aria-[invalid]:bg-red-50
                            aria-[invalid]:border-red-500
                            aria-[invalid]:outline-red-500"
        
                            @error('adviser_id') aria-invalid="true" @enderror
                            @if(!$editing) disabled @endif>
                                <option value="Walt">Walter White</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="my-4 rounded-full overflow-clip inline-flex transition hover:scale-[103%] shadow hover:shadow-lg cursor-pointer" wire:click="$set('selected_tab','students')">
                    <div class="text-nowrap bg-blue-500 w-full flex justify-center items-center py-2 px-5">
                        <div class="flex gap-2">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                  </svg>
                            </div>
                            <div class="w-full">
                                <div class="block text-lg font-bold">9</div>
                                <div class="block text-blue-300">Students</div> 
                            </div> 
                        </div>
                    </div>
                    <div class="w-full flex bg-white text-slate-600 py-2 px-4 gap-2">
                        <div class="w-full flex justify-center items-center px-4">
                            <div>
                                <div class="block text-center w-full font-bold">9</div>
                                <div class="block text-center w-full text-slate-400">Male</div>
                            </div>
                        </div>
                        <div class="w-full flex justify-center items-center px-4">
                            <div>
                                <div class="block text-center w-full font-bold">9</div>
                                <div class="block text-center w-full text-slate-400">Female</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    
            <div class="w-full">
                <div class="block rounded bg-white p-2">
                    <div class="block mb-2">
                        <table class="w-full">
                            <thead>
                                <tr class="h-10 border-b">
                                    <td class="px-2 text-center hover:bg-slate-100 group/tab cursor-pointer" 
                                    @if($selected_tab == 'subjects') aria-selected="true" @endif 
                                    wire:click="$set('selected_tab','subjects')">
                                        <div>
                                            <span class="mx-3 mb-2 block group-aria-selected/tab:text-blue-500"><i class="bi bi-book"></i> Subjects</span>
                                            <div class="h-[3px] group-aria-selected/tab:bg-blue-500"></div>
                                        </div>
                                    </td>
                                    <td class="px-2 text-center hover:bg-slate-100 group/tab cursor-pointer" 
                                    @if($selected_tab == 'students') aria-selected="true" @endif 
                                    wire:click="$set('selected_tab','students')">
                                        <div>
                                            <span class="mx-3 mb-2 block group-aria-selected/tab:text-blue-500" ><i class="bi bi-people"></i> Students</span>
                                            <div class="h-[3px] group-aria-selected/tab:bg-blue-500"></div>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="hidden aria-[tab-selected]:block" @if($selected_tab == 'subjects') aria-tab-selected="true" @endif>
                        <h3 class="text-xl mb-2">Subjects</h3>
                        <table class="w-full border rounded text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Classroom subjects</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($subjects as $subject)
            
                                <tr class="bg-white border-b">
                                    <td scope="col" class="px-6 py-2">
                                        <div class="flex items-center">
                                            <span class="w-full">{{$subject->name}}</span>
                                            <button class="text-red-500" title="remove subject" wire:click="deleteSubject({{$subject->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                                
                                <tr class="bg-white border-b">
                                    <td>
                                        <div class="p-1 inline-flex gap-2 w-full my-2 px-6">
                                            <input type="text" class="border rounded-full bg-slate-50 py-1 px-2 w-full 
                                            aria-[invalid]:bg-red-50
                                            aria-[invalid]:border-red-500
                                            aria-[invalid]:outline-red-500" 
            
                                            placeholder="New subject"
                                            @error('new_subject') aria-invalid="true" @enderror
                                            wire:model="new_subject">
                                            <button class="border border-slate-400 rounded-full py-1 px-2 text-nowrap bg-slate-200" wire:click="addNewSubject()">
                                                Add subject
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="block mt-20 text-sm">
                            <span class="block italic">
                                Select a curriculum to add its subjects to the classroom
                            </span>
                            <label for="">Select curriculum
                            </label>
                            <select type="text" class="border rounded p-1 bg-slate-50 text-slate-600 outline-slate-600" wire:model.live="curriculum_id">
                                <option value="0">----</option>
                                @foreach ($curricula as $curriculum)
                                    <option value="{{$curriculum->id}}">{{$curriculum->name}}</option>
                                @endforeach
                            </select>
                            <button class="rounded-full border bg-blue-500 hover:bg-blue-600 text-white px-3 py-1" wire:click="addCurriculumSubjectsToClassroom()">
                                Add subjects
                            </button>
                        </div>
                        
                        @if ($curriculum_id)
        
                        <div class="mt-5">
                            Curriculum: <span class="rounded bg-slate-500 text-white mt-5 p-1">{{$selected_curriculum->name}}</span>
                        </div>
                        
                        <div class="block relative mt-2">
                            <x-loader/>
                            
        
                            <table class="w-full border rounded text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Curriculum subjects</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($selected_curriculum->subjects as $subject)
                
                                    <tr class="bg-white border-b">
                                        <td scope="col" class="px-6 py-3">{{$subject->name}}</td>
                                    </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
            
                        </div>
                        
                        @endif
                    </div>
                </div>

                @if (false)
                    
                <div class="block mt-2">
                    <div class="rounded text-green-700 bg-green-50 p-4">
                        Classroom successfully added!
                    </div>
                </div>
                
                @endif
            </div>
        </div>
        
        <div class="block text-end mt-2">
            @if ($editing)
                
            <button class="text-white border rounded-full bg-blue-500 outline-blue-700 inline-flex gap-1 py-1 px-2 hover:bg-blue-600"
            wire:click="save()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>                  
                Update
            </button>

            <button class="text-white border rounded-full bg-red-500 outline-red-700 inline-flex gap-1 py-1 px-2 hover:bg-red-600"
            wire:click="$toggle('editing')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>                               
                Cancel
            </button>

            @endif

            <button class="text-white border rounded-full 
            bg-yellow-500 
            outline-yellow-700 inline-flex gap-1 py-1 px-2 
            hover:bg-yellow-600
            aria-[editing]:hidden"
            wire:click="$toggle('editing')"
            @if ($editing) aria-editing @endif>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>                               
                Edit
            </button>
        </div>
        
        {{-- loader div --}}
        <x-loader/>
    </div>
</div>
