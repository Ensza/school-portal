<tr class="border-b hover:bg-slate-200 relative strand-row" row-id="{{$strand->id}}">
    @if($editing)

    {{-- if editing strand row --}}
    <td class="p-4 w-full">
        <input type="text" class="border p-1 px-2 w-full rounded-full aria-[invalid]:border-red-300 aria-[invalid]:focus:outline-red-600 aria-[invalid]:bg-red-50 focus:outline-blue-400" @error('name') aria-invalid="true" @enderror wire:model.blur="name" placeholder="Must not be empty">

        {{-- loader div --}}
        <x-loader/>
        
    </td>
    <td class="px-4 text-center">
        <input type="text" class="border p-1 px-2 rounded-full aria-[invalid]:border-red-300 aria-[invalid]:focus:outline-red-600 aria-[invalid]:bg-red-50 focus:outline-blue-400 w-[7em]" @error('name') aria-invalid="true" @enderror wire:model.blur="code" placeholder="Must be unique">
    </td>

    @else

    <td class="p-4 w-full">
        <span>{{$strand->name}}</span>

        {{-- loader div --}}
        <x-loader/>

    </td>
    <td class="px-4 text-center">
        <span class="font-bold">{{$strand->code}}</span>
    </td>

    @endif

    
    <td class="px-4 text-nowrap text-center">
        @if ($editing)
        
        <button class="text-green-600 hover:scale-125" title="Confirm edit" wire:click="edit()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>              
        </button>

        @else
        
        <button class="hover:text-yellow-600" title="Edit" wire:click="enableEdit()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
        </button>
        <button class="hover:text-red-600 ms-1" title="Delete" wire:click="delete()" wire:confirm="Are you sure you want to delete strand {{$strand->code}}?">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>                              
        </button>

        @endif

        <button class="text-red-600 hover:scale-125 @if (!$editing) hidden @endif" title="Cancel edit" wire:click="$toggle('editing')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>                                          
        </button>
    </td>

    @if ($deleted)
    @script
    <script type="module">
        $('.strand-row[row-id="{{$strand->id}}"]').fadeOut('fast');
    </script>
    @endscript
    @else
    @script
    <script type="module">
        $('.strand-row[row-id="{{$strand->id}}"]').hide().fadeIn('fast');
    </script>
    @endscript
    @endif
</tr>