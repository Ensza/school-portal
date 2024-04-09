<div>
    <img src="{{asset('storage/profile-pictures/default.png')}}" class="w-20" alt="">
    <input type="file" class="border rounded p-2" wire:model="file">
    <button wire:click="debug()"
    class="rounded border bg-slate-200 p-2 shadow hover:bg-slate-300">
        debug
    </button>

    <button wire:click="save()"
    class="rounded border bg-slate-200 p-2 shadow hover:bg-slate-300">
        save
    </button>
</div>
