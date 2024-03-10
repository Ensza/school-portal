<div class="relative">
    @if ($creating)
        <table class="w-full text-left">
            <tbody>
                <tr>
                    <th class="px-2">Strand name</th>
                    <th class="px-2">Strand code</th>
                </tr>
                <tr>
                    <td class="px-2"><input type="text" class="w-full rounded-full px-1 py-1 border aria-[invalid]:outline-red-500 aria-[invalid]:border-red-300 aria-[invalid]:bg-red-50 outline-blue-500" @error('name') aria-invalid="true" @enderror placeholder="Must not be empty" wire:model="name"></td>
                    <td class="px-2"><input type="text" class="w-full rounded-full px-1 py-1 border aria-[invalid]:outline-red-500 aria-[invalid]:border-red-300 aria-[invalid]:bg-red-50 outline-blue-500" @error('code') aria-invalid="true" @enderror placeholder="Must be unique" wire:model="code"></td>
                </tr>
            </tbody>
        </table>
        <div class="text-center py-2">
            <button type="button" class="transition text-success rounded-full p-1 hover:bg-blue-700 text-white bg-blue-500 px-3" wire:click="create()">
                Add <i class="bi bi-plus-lg"></i>
            </button>
            <button type="button" class="transition text-success rounded-full p-1 ms-1 mt-2 hover:bg-red-700 text-white bg-red-500 px-3" wire:click="$toggle('creating')">
                Cancel 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
            </button>
        </div>
    @else
    <button type="button" class="transition text-success rounded-full p-1 hover:bg-green-700 text-white bg-green-500 px-3" wire:click="$toggle('creating')">
        Add strand <i class="bi bi-plus-lg"></i>
    </button>
    @endif

    {{-- loader div --}}
    <x-loader/>
    
</div>
