<div class="w-full top-0 left-0 z-10 overflow-auto py-4">
    
    <div class="w-full lg:mx-auto rounded p-2 relative min-w-[300px] overflow-clip">
        @if($enable_close_button)
            <button class="absolute top-0 right-0 text-white me-1 mt-1" wire:click="$parent.unsetSelectedClassroom()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>                  
            </button>
        @endif

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

                            placeholder="Must not be empty"
                            value="{{$classroom->name}}" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-2 mb-2">
                        <label class="col-span-4 text-sm">Strand</label>
                        <div class="col-span-8">
                            <input type="text" class="w-full border rounded p-1 text-slate-600 outline-slate-600
                            aria-[invalid]:bg-red-50
                            aria-[invalid]:border-red-500
                            aria-[invalid]:outline-red-500"

                            placeholder="Must not be empty"
                            value="{{$classroom->strand->name}}" readonly>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-12 gap-2 mb-2">
                        <label class="col-span-4 text-sm">Adviser</label>
                        <div class="col-span-8">
                            <input type="text" class="w-full border rounded p-1 text-slate-600 outline-slate-600
                            aria-[invalid]:bg-red-50
                            aria-[invalid]:border-red-500
                            aria-[invalid]:outline-red-500"

                            value="Walter White" readonly>
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
                                    x-on:click="show_tab = 'subjects'"
                                    >
                                        <div>
                                            <span class="mx-3 mb-2 block group-aria-selected/tab:text-blue-500"><i class="bi bi-book"></i> Subjects</span>
                                            <div class="h-[3px] group-aria-selected/tab:bg-blue-500"></div>
                                        </div>
                                    </td>
                                    <td class="px-2 text-center hover:bg-slate-100 group/tab cursor-pointer" 
                                    x-bind:aria-selected="show_tab == 'students'"
                                    x-on:click="show_tab = 'students'"
                                    >
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

                                @foreach ($classroom->subjects as $subject)
            
                                <tr class="bg-white border-b">
                                    <td scope="col" class="px-6 py-2">
                                        <div class="flex items-center">
                                            <span class="w-full">{{$subject->name}}</span>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="block text-end mt-2">
            
        </div>
    
        <div class="text-center mt-8">

            <button wire:click="enroll()" wire:confirm="Are you sure you want to withdraw enrolling in this classroom?" 
            @if (!(auth()->user()->profile->classroom_id == $classroom->id && !auth()->user()->profile->is_enrolled)) 
            aria-hidden="true"
            @endif
            class="rounded bg-yellow-300 text-slate-700 py-2 px-4 inline-flex gap-2 justify-center items-center shadow transition hover:bg-yellow-400
            aria-hidden:hidden">
                <i class="bi bi-hourglass text-lg"></i>
                <span>Pending enrollment (Click to cancel)</span>
            </button>

            <button wire:click="enroll()"
            @if (auth()->user()->profile->classroom_id == $classroom->id && !auth()->user()->profile->is_enrolled) 
            aria-hidden="true"
            @endif
            class="rounded bg-green-500 py-2 px-4 inline-flex gap-2 justify-center items-center shadow text-white transition hover:bg-green-600
            aria-hidden:hidden">
                <i class="bi bi-box-arrow-in-left text-lg"></i>
                <span>Enroll to this classroom</span>
            </button>
            
        </div>
        
        {{-- loader div --}}
        <x-loader/>
    </div>
</div>
