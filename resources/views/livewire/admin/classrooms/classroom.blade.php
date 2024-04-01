<div class="w-full top-0 left-0 z-10 overflow-auto py-4">
    
    <div class="w-full lg:mx-auto rounded p-2 relative min-w-[300px]">
        <button class="absolute top-0 right-0 text-white me-1 mt-1" wire:click="$parent.unsetSelectedClassroom()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>                  
        </button>

        <h2 class="text-2xl mb-2 text-white">{{$classroom->name}}</h2>
        <div class="gap-2 w-full">
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

                <div class="my-4 rounded-full overflow-clip inline-flex transition hover:scale-[103%] shadow hover:shadow-lg cursor-pointer">
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
    
            <div class="w-full" x-data="{show_tab : 'subjects'}">
                <div class="block rounded bg-white p-2">
                    <div class="block mb-2">
                        <table class="w-full">
                            <thead>
                                <tr class="h-10 border-b">
                                    <td class="px-2 text-center hover:bg-slate-100 group/tab cursor-pointer" 
                                    x-bind:aria-selected="show_tab == 'subjects'"
                                    x-on:click="show_tab = 'subjects'">
                                        <div>
                                            <span class="mx-3 mb-2 block group-aria-selected/tab:text-blue-500"><i class="bi bi-book"></i> Subjects</span>
                                            <div class="h-[3px] group-aria-selected/tab:bg-blue-500"></div>
                                        </div>
                                    </td>
                                    <td class="px-2 text-center hover:bg-slate-100 group/tab cursor-pointer" 
                                    x-bind:aria-selected="show_tab == 'students'"
                                    x-on:click="show_tab = 'students'">
                                        <div>
                                            <span class="mx-3 mb-2 block group-aria-selected/tab:text-blue-500" ><i class="bi bi-people"></i> Students</span>
                                            <div class="h-[3px] group-aria-selected/tab:bg-blue-500"></div>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="hidden aria-[tab-selected]:block" x-bind:aria-tab-selected="show_tab == 'subjects'">
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
                
                                    <tr class="bg-slate-300 border-b">
                                        <td scope="col" class="px-6 py-3">{{$subject->name}}</td>
                                    </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
            
                        </div>
                        
                        @endif
                    </div>

                    <div class="hidden aria-[tab-selected]:block" x-bind:aria-tab-selected="show_tab == 'students'">
                        <h3 class="text-xl mb-2">Students</h3>

                        {{-- admitted students --}}
                        <div class="block my-8">
                            <div class="my-2">Admitted students</div>
                            <div class="">
                                <div class="inline-flex gap-2 items-center text-sm">
                                    Search
                                    <input type="text" wire:model="search_students" wire:keyup="filterStudents()"
                                    class="rounded border py-1 px-2 outline-slate-500">
                                </div>
                            </div>
                            <div class="block p-2">
                                <div class="w-full grid grid-cols-4 lg:grid-cols-6 rounded-full shadow p-2 my-2 bg-slate-600 text-slate-50 text-sm font-bold px-4 gap-2">
                                    <div class="col-span-3 md:col-span-1 lg:hidden inline-flex" wire:click="sortStudents('name')">
                                        Name 
                                        @if ($sort_students_by == 'name')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="hidden lg:inline-flex cursor-pointer" wire:click="sortStudents('last_name')">
                                        Last name 
                                        @if ($sort_students_by == 'last_name')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="hidden lg:inline-flex cursor-pointer" wire:click="sortStudents('first_name')">
                                        First name 
                                        @if ($sort_students_by == 'first_name')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="hidden lg:inline-flex cursor-pointer" wire:click="sortStudents('middle_name')">
                                        Middle name 
                                        @if ($sort_students_by == 'middle_name')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="hidden md:inline-flex col-span-2 cursor-pointer" wire:click="sortStudents('email')">
                                        Email 
                                        @if ($sort_students_by == 'email')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div>
                                        Action
                                    </div>
                                </div>
                                @foreach ($students as $student)
                
                                <div x-data="{expanded: false}" x-on:click="expanded =! expanded"
                                class="w-full grid grid-cols-4 lg:grid-cols-6 rounded-[30px] bg-slate-100 hover:bg-slate-200 cursor-pointer shadow py-2 my-2 text-sm px-4 gap-x-2">
                                    <div class="col-span-3 md:col-span-1 lg:hidden">
                                        {{$student->first_name.' '.$student->middle_name.' '.$student->last_name}}
                                    </div>
                                    <div class="hidden lg:block">
                                        {{$student->last_name}}
                                    </div>
                                    <div class="hidden lg:block">
                                        {{$student->first_name}}
                                    </div>
                                    <div class="hidden lg:block">
                                        {{$student->middle_name}}
                                    </div>
                                    <div class="hidden md:block col-span-2">
                                        {{$student->user->email}}
                                    </div>
                                    <div>
                                        a
                                    </div>

                                    <div class="col-span-full max-h-0 overflow-clip transition-all aria-expanded:block aria-expanded:max-h-[1000px]" x-bind:aria-expanded="expanded">
                                        <div x-on:click.stop x-on:hover.stop
                                        class="p-2 w-full border rounded-lg shadow-inner bg-white cursor-auto mt-5 mb-2">
                                            <div class="text-lg py-10 px-4 rounded bg-blue-500 text-white">{{$student->last_name.', '.$student->first_name.' '.$student->middle_name}}</div>
                                            
                                            <div class="lg:w-3/4 mx-auto my-8">
                                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                                                    <div class="mt-1 col-start-1 text-lg">Student information</div>
                                                    <label for="" class="text-slate-500 col-start-1">Email</label>
                                                    <div class="mb-3">
                                                        <input type="text" class="rounded py-1 px-2 border bg-slate-100 w-full" value="{{$student->user->email}}" readonly>
                                                    </div>

                                                    <label for="" class="text-slate-500 col-start-1">Last name</label>
                                                    <div class="mb-1">
                                                        <input type="text" class="rounded py-1 px-2 border bg-slate-100 w-full" value="{{$student->last_name}}" readonly>
                                                    </div>

                                                    <label for="" class="text-slate-500 col-start-1">First name</label>
                                                    <div class="mb-1">
                                                        <input type="text" class="rounded py-1 px-2 border bg-slate-100 w-full" value="{{$student->first_name}}" readonly>
                                                    </div>

                                                    <label for="" class="text-slate-500 col-start-1">Middle name</label>
                                                    <div class="mb-3">
                                                        <input type="text" class="rounded py-1 px-2 border bg-slate-100 w-full" value="{{$student->middle_name}}" readonly>
                                                    </div>

                                                    <label for="" class="text-slate-500 col-start-1">Birthday</label>
                                                    <div class="mb-3">
                                                        <input type="text" class="rounded py-1 px-2 border bg-slate-100 w-full" value="{{date_format($student->birthday,"F d, Y")}}" readonly>
                                                    </div>
                                                    
                                                    <div class="mt-1 col-start-1 text-lg">Address</div>
                                                    <label for="" class="text-slate-500 col-start-1">House and Street</label>
                                                    <div class="mb-1">
                                                        <input type="text" class="rounded py-1 px-2 border bg-slate-100 w-full" value="{{$student->house_and_street}}" readonly>
                                                    </div>

                                                    <label for="" class="text-slate-500">City / Municipality</label>
                                                    <div class="mb-1">
                                                        <input type="text" class="rounded py-1 px-2 border bg-slate-100 w-full" value="{{$student->city_or_municipality}}" readonly>
                                                    </div>

                                                    <label for="" class="text-slate-500">Province</label>
                                                    <div class="mb-1">
                                                        <input type="text" class="rounded py-1 px-2 border bg-slate-100 w-full" value="{{$student->province}}" readonly>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-full flex justify-center pt-1">
                                        <div class="transition aria-expanded:rotate-180" x-bind:aria-expanded="expanded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>                                          
                                        </div>                                 
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>

                        {{-- pending students --}}
                        <div class="block my-8">
                            <div class="my-2">Pending admissions</div>
                            <div class="text-sm text-orange-500 inline-flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                </svg>
                                Please make sure the email of the student is correct before admitting a student
                            </div>
                            
                            <div class="block p-2">
                                <div class="w-full grid grid-cols-6 rounded-full shadow p-2 my-2 bg-slate-600 text-slate-50 text-sm font-bold px-4 gap-2">
                                    <div class="hidden md:inline-flex lg:hidden col-span-2 cursor-pointer" wire:click="sortPendingStudents('name')">
                                        Name 
                                        @if ($sort_pending_students_by == 'name')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="hidden lg:inline-flex cursor-pointer" wire:click="sortPendingStudents('first_name')">
                                        First name 
                                        @if ($sort_pending_students_by == 'first_name')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="hidden lg:inline-flex cursor-pointer" wire:click="sortPendingStudents('middle_name')">
                                        Middle name 
                                        @if ($sort_pending_students_by == 'middle_name')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="hidden lg:inline-flex cursor-pointer" wire:click="sortPendingStudents('last_name')">
                                        Last name 
                                        @if ($sort_pending_students_by == 'last_name')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="col-span-4 md:col-span-2 inline-flex cursor-pointer" wire:click="sortPendingStudents('email')">
                                        Email 
                                        @if ($sort_pending_students_by == 'email')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="text-center col-span-2 lg:col-span-1">
                                        Action
                                    </div>
                                </div>
                                @foreach ($pending_students as $student)
                
                                <div x-data="{expanded: false}" x-on:click="expanded =! expanded"
                                class="w-full grid grid-cols-6 rounded-[30px] bg-slate-100 hover:bg-slate-200 cursor-pointer shadow py-2 my-2 text-sm px-4 gap-x-2">
                                    <div class="hidden md:block lg:hidden col-span-2">
                                        {{$student->first_name.' '.$student->middle_name.' '.$student->last_name}}
                                    </div>
                                    <div class="hidden lg:block">
                                        {{$student->first_name}}
                                    </div>
                                    <div class="hidden lg:block">
                                        {{$student->middle_name}}
                                    </div>
                                    <div class="hidden lg:block">
                                        {{$student->last_name}}
                                    </div>
                                    <div class="col-span-4 md:col-span-2">
                                        {{$student->user->email}}
                                    </div>
                                    <div class="inline-flex justify-center gap-2 col-span-2 lg:col-span-1" x-on:click.stop>
                                        <button wire:click="admit({{$student->id}})" wire:confirm="Are you sure you want to admit this student?"
                                        class="rounded text-white bg-green-500 hover:bg-green-600 py-1 px-2 text-sm">
                                            Admit
                                        </button>
                                        <button class="rounded text-white bg-red-500 hover:bg-red-600 py-1 px-2 text-sm">
                                            Reject
                                        </button>
                                    </div>

                                    <div class="col-span-full flex justify-center pt-1">
                                        <div class="transition aria-expanded:rotate-180" x-bind:aria-expanded="expanded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>                                          
                                        </div>                                 
                                    </div>
                                    <div class="col-span-full max-h-0 overflow-clip transition-all aria-expanded:block aria-expanded:max-h-[1000px]" x-bind:aria-expanded="expanded">
                                        <div x-on:click.stop x-on:hover.stop
                                        class="p-2 w-full border-t border-slate-300 cursor-auto mt-2">
                                            aw <br>
                                            aw <br>
                                            aw <br>
                                            aw <br>
                                            aw <br>
                                            aw <br>
                                            aw <br>
                                            aw <br>
                                            aw <br>
                                            aw <br>
                                            aw <br>
                                            aw <br>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                        
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
