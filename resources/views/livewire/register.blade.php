<div class="p-2 flex">
    <div class="p-4 border border-slate-400 rounded bg-white bg-opacity-5 backdrop-blur-sm mx-auto text-slate-50 w-full xl:w-1/2 shadow-lg">
        <h2 class="text-xl">Register</h2>
        <h4 class="text-sm text-slate-400 mb-10">Fill up each field. Fields with <span class="text-pink-500">*</span> are required.</h4>
        <form wire:submit="submit()">
            <div class="grid md:grid-cols-4 gap-y-2 gap-x-4 text-sm mt-4">

                <label for="email" class="">Email<span class="text-pink-500">*</span></label>
                <div class="mb-2">
                    <input id="email" type="email" required wire:model.blur="email"
                    @error('email') aria-invalid @enderror
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>

                <label for="password" class="col-start-1">Password<span class="text-pink-500">*</span></label>
                <div class="mb-2">
                    <input id="password" type="password" minlength="8" required wire:model.live="password"
                    @error('password') aria-invalid @enderror
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    "
                    required>
                    @error('password') <span class="text-pink-500 block">{{$message}}</span> @enderror
                </div>

                <label for="confirm-password">Confirm password<span class="text-pink-500">*</span></label>
                <div class="mb-5">
                    <input id="confirm-password" type="password" minlength="8" required wire:model.live="password_confirmation"
                    @error('password') aria-invalid @enderror
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>

                <h2 class="col-start-1 text-xl mb-2 text-slate-300">Name</h2>
                
                <label for="first-name" class="col-start-1">First name<span class="text-pink-500">*</span></label>
                <div class="mb-2">
                    <input id="first-name" type="text" required
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>

                <label for="middle-name" class="col-start-1">Middle name</label>
                <div class="mb-2">
                    <input id="middle-name" type="text" 
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>

                <label for="last-name" class="col-start-1">Last name<span class="text-pink-500">*</span></label>
                <div class="mb-5">
                    <input id="last-name" type="text" required
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>

                <h2 class="col-start-1 text-xl mb-2 text-slate-300">Birthday</h2>
                
                <label for="birthday" class="col-start-1">Birthday<span class="text-pink-500">*</span></label>
                <div class="mb-2">
                    <input id="birthday" type="text" required autocomplete="off"
                    {{-- Since livewire can't listen to javascript input change from a datepicker, 
                    a workaround is to set the birthday value on input focusout --}}
                    wire:focusout="$set('birthday', $('#birthday').val())"

                    @error('birthday') aria-invalid @enderror
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>

                <h2 class="col-start-1 text-xl mb-2 text-slate-300">Address</h2>
                
                <label for="house_and_street" class="col-start-1">House no. and street<span class="text-pink-500">*</span></label>
                <div class="mb-5">
                    <input id="house_and_street" type="text" required
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>
            </div>

            <div class="block mt-5">
                <button type="submit"
                class="bg-blue-500 rounded-full px-2 py-1 hover:bg-blue-600 text-sm">
                    Submit
                </button>
            </div>
        </form>

        @if ($errors->any())
        <div class="block p-2 rounded border border-pink-500 bg-pink-50 text-pink-500 mt-10">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </div>
        @endif
    </div>
    
    @script
    <script type="module">
        new Datepicker($('#birthday')[0], {
            autohide: true,
            maxDate: new Date()
        }); 
    </script>
    @endscript
</div>
