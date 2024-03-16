<div class="w-full top-0 left-0 z-10 overflow-auto py-4">
    
    <div class="w-full lg:mx-auto rounded p-2 relative min-w-[300px] border border-slate-50">
        <button class="absolute top-0 right-0 text-white me-1 mt-1" wire:click="$parent.closeAddClassroom()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>                  
        </button>

        <h2 class="text-2xl mb-2 text-white">Add classroom</h2>
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
                            wire:model="name">
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
                            wire:model="strand_id">
                                <option value="0">----</option>
                                @foreach ($strands as $strand)
                                    <option value="{{$strand->id}}">{{$strand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="w-full">
                <div class="block rounded bg-white p-2">
                    <h3 class="text-xl mb-2">Subjects</h3>
                    <table class="w-full border rounded text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Classroom subjects</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subject_index = 0;
                            @endphp
                            @foreach ($subjects as $subject)
        
                            <tr class="bg-white border-b">
                                <td scope="col" class="px-6 py-2">
                                    <div class="flex items-center">
                                        <span class="w-full">{{$subject}}</span>
                                        <button class="text-red-500" title="remove subject" wire:click="removeSubject({{$subject_index}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                          </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $subject_index++;
                            @endphp
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
                        <button class="rounded-full border bg-blue-500 hover:bg-blue-600 text-white px-3 py-1" wire:click="addCurriculumSubjectsToNewClass()">
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
                @if ($classroom_created)
                    
                <div class="block mt-2">
                    <div class="rounded text-green-700 bg-green-50 p-4">
                        Classroom successfully added!
                    </div>
                </div>
                
                @endif
                <div class="block text-end mt-2">
                    <button class="text-white border rounded-full bg-green-500 outline-green-700 inline-flex gap-1 py-1 px-2 hover:bg-green-600"
                    wire:click="save()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                          </svg>                  
                        Save
                    </button>
                </div>
            </div>
        </div>
        
        {{-- loader div --}}
        <x-loader/>
    </div>
</div>
