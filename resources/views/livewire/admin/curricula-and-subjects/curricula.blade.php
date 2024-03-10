<div class="mb-4 relative">
    <div class="mb-2">
        <div>
            <label for="">Strand</label>
            <select class="border border-slate-400 rounded-full px-2" wire:model.live="selected_strand_id">
                <option value="0">All strands</option>
                @foreach ($strands as $strand)
                <option value="{{$strand->id}}">{{$strand->code}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if ($curricula->count()<1)

    <div class="w-full text-center">
        <span class="text-3xl text-slate-500">No curriculum</span>
    </div>

    @else

    <div class="grid md:grid-cols-2 gap-4">
        @foreach ($curricula as $curriculum)
        <livewire:admin.curricula-and-subjects.curriculum-card :$curriculum :key="$curriculum->id" />
        @endforeach
    </div>

    @endif

    {{-- loader div --}}
    <x-loader/>
</div>
