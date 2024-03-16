<div class="track-card" row-id="{{$track->id}}">
    <div class="relative rounded-lg border bg-white shadow">
        <div class=" bg-slate-100 p-2 border-b rounded-t-md flex items-center">
            <div class="w-full grid track-header" row-id="{{$track->id}}">
                {{-- header --}}

                @if ($editing)
                
                <div class="flex mb-2">
                    <label class="font-semibold me-2">Track name</label>
                    <input type="text" class="rounded border block outline-blue-500 py-0 px-1 aria-[inavlid]:border-2 aria-[inavlid]:border-red-300 aria-[inavlid]:bg-red-50" @error('name') aria-invalid="true" @enderror wire:model="name" placeholder="Track name here">
                </div>

                <div class="flex">
                    <label class="font-semibold me-2">Track code (unique)</label>
                    <input type="text" class="rounded border block outline-blue-500 py-0 px-1 aria-[inavlid]:border-2 aria-[inavlid]:border-red-300 aria-[inavlid]:bg-red-50" @error('code') aria-invalid="true" @enderror wire:model="code" placeholder="Must be unique">
                </div>

                @else

                <span class="me-2">{{$track->name}}</span>
                <span class="font-semibold">{{$track->code}}</span>
                
                @endif
            </div>

            @if($editing)

            <button class="mx-2 text-green-600 transition scale-125 hover:scale-[1.6] track-edit-button" type="button" row-id="{{$track->id}}" wire:click="edit()" title="Confirm edit">
                <i class="bi bi-check-lg"></i>
            </button>

            @else
            
            <button class="mx-3 text-slate-800 transition hover:scale-110 track-edit-button" type="button" row-id="{{$track->id}}" wire:click="enableEdit()" title="Edit">
                <i class="bi bi-pencil-fill"></i>
            </button>

            @endif

            <button class="text-red-500 {{$editing ? ' ' : 'hidden'}} transition scale-150 hover:scale-[1.8] track-edit-button" type="button" row-id="{{$track->id}}" wire:click="$toggle('editing')" title="Cancel edit">
                <i class="bi bi-x"></i>
            </button>

            <button class="{{$disabled ? 'text-slate-400' : 'text-red-500 transition hover:scale-110'}} {{!$editing ? '' : 'hidden'}} track-edit-button" type="button" row-id="{{$track->id}}" title="Delete"
                @if ($disabled)
                data-tooltip-target="tooltip-{{$track->id}}"
                disabled
                @else
                wire:click="delete"
                @endif 
                wire:confirm="Are you sure you want to delete {{$track->code}}?"><i class="bi bi-trash-fill"></i>
            </button>
            @if($disabled)
            <div id="tooltip-{{$track->id}}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Tracks with strands cannot be deleted
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            @endif
        </div>

        <div class="bg-slate-50">
            {{-- body --}}
            @if ($track->strands->count())
            <table class="w-full">
                <tbody>
                    @foreach ($track->strands as $strand)
                    <livewire:admin.tracks-and-strands.strand-row :$strand :key="$strand->id"/>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="w-full p-4 text-slate-500 text-center">
                This track has no strand, click Add strand below
            </div>
            @endif
        </div>

        <div class=" bg-slate-100 p-1 border-t rounded-b-md text-center">
            {{-- footer --}}
            <livewire:admin.tracks-and-strands.create-strand :track_id="$track->id" @strand-created="$refresh" />
        </div>

        {{-- loader div --}}
        <x-loader/>
        
    </div>
    @if ($deleted)
    @script
    <script type="module">
        $('.track-card[row-id="{{$track->id}}"]').fadeOut('fast');
    </script>
    @endscript
    @else
    @script
    <script type="module">
        $('.track-card[row-id="{{$track->id}}"]').hide().fadeIn('fast');
    </script>
    @endscript
    @endif
</div>

