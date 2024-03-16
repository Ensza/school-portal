<div class="flex border-b p-2 text-slate-700 hover:bg-slate-100 relative subject" row-id="{{$subject->id}}">
    @if ($editing)

    <div class="w-full">
        <input type="text" class="border shadow-inner rounded p-1 w-full text-slate-600 outline-blue-500 aria-[invalid]:border-red-500 aria-[invalid]:bg-red-50 aria-[invalid]:outline-red-500" @error('name') aria-invalid="true" @enderror placeholder="Must not be empty" wire:model="name">
    </div>
    <div class="flex items-center text-nowrap px-3">
        <button class="text-green-700" title="confirm edit" wire:click="edit()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
              </svg>                          
        </button>
        <button class="ms-2 text-red-400 hidden" title="delete" wire:click="delete()" wire:confirm="Are you sure you want to delete subject {{$subject->name}} from ?">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
              </svg>                           
        </button>
        <button class="ms-2 text-red-400" title="cancel edit" wire:click="$toggle('editing')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>                                    
        </button>
    </div>

    @else

    <div class="w-full">
        <span>{{$subject->name}}</span>
    </div>
    <div class="flex items-center text-nowrap px-3 text-slate-500">
        <button class="hover:text-blue-600" title="edit" wire:click="toggleEditing()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
              </svg>              
        </button>
        <button class="ms-2 hover:text-red-400" title="delete" wire:click="delete()" wire:confirm="Are you sure you want to delete subject {{$subject->name}} from ?">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
              </svg>                           
        </button>
    </div>

    @endif

    
    {{-- loader div --}}
    <x-loader/>

    
    @script
    <script type="module">
        $('.subject[row-id="{{$subject->id}}"]').hide().fadeIn('fast');
    </script>
    @endscript

    @if ($deleted)
    @script
    <script type="module">
        $('.subject[row-id="{{$subject->id}}"]').fadeOut('fast', function(){
            $(this).hide();
        });
    </script>
    @endscript
    @endif
</div>
