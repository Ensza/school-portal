<div class="mt-5 mb-5 w-full">
    <form class="" wire:submit="create">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-1">
            <div class="p-2">
                <div class="mb-5">
                    <label for="track-name" class="block font-semibold">Curriculum name</label>
                    <input type="text" class="w-full block border rounded p-1 aria-[invalid]:border-red-300 aria-[invalid]:bg-red-50 aria-[invalid]:outline-red-500 bg-slate-100 outline-blue-500" @error('name') aria-invalid="true" @enderror id="track-name" placeholder="Curriculum name here" wire:model="name" required>
                </div>
            </div>
            <div class="p-2">
                <div class="mb-5">
                    <label for="strand-select" class="block font-bold">Strand</label>
                    <select id="strand-select" class="w-full block border rounded p-1 aria-[invalid]:border-red-300 aria-[invalid]:bg-red-50 aria-[invalid]:outline-red-500 bg-slate-100 outline-blue-500" @error('strand_id') aria-invalid="true" @enderror wire:model.live="strand_id">
                        <option value="">-- Select strand --</option>
                        @foreach ($strands as $strand)
                        <option value="{{$strand->id}}">{{$strand->name}} - <span class="font-bold">{{$strand->code}}</span></option>
                        @endforeach
                    </select>
                </div>
            </div>
            @csrf
            <div class="flex items-center">
                <button type="submit" class="mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:loading.attr="disabled">
                    <span wire:loading.remove>Add curriculum</span>
                    <div class="" role="status" wire:loading>
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                        </svg>
                        Loading..
                    </div>
                </button>
            </div>
        </div>
    </form>
    <div class="w-full mt-2">
        <div>
            @if ($errors->any())
            <div wire:transition id="tracks-add-alert" class="block border border-red-500 bg-red-100 text-red-900 p-3 rounded" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
            @endif
        </div>

        @if ($created)
        @script
        <script type="module">
            $("#content").animate({ scrollTop: $('#content').height() }, 1000);
        </script>
        @endscript
        <div class="p-2">
            <div id="tracks-add-alert" class="flex border border-green-500 bg-green-100 text-green-900 p-3 rounded" role="alert">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                  </svg>       
                </span>           
                <span>Curriculum added!</span>
            </div>
        </div>
            
        @endif
    </div>
</div>

