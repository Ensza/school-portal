<div class="p-5 flex">
    <div @if($verifying_email || $email_verified) hidden @endif
    class="p-4 border border-slate-400 rounded bg-white bg-opacity-5 backdrop-blur-sm mx-auto text-slate-50 w-full xl:w-1/2 shadow-lg relative">
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
                    <input id="password" type="password" minlength="8" required wire:model="password"
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
                    <input id="confirm-password" type="password" minlength="8" required wire:model="password_confirmation"
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
                    <input id="first-name" type="text" required wire:model="first_name"
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>

                <label for="middle-name" class="col-start-1">Middle name</label>
                <div class="mb-2">
                    <input id="middle-name" type="text" wire:model="middle_name"
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>

                <label for="last-name" class="col-start-1">Last name<span class="text-pink-500">*</span></label>
                <div class="mb-5">
                    <input id="last-name" type="text" required wire:model="last_name"
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
                <div class="mb-2">
                    <input id="house_and_street" type="text" required wire:model="house_and_street"
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>

                <label for="city_municipality" class="">City / Municipality<span class="text-pink-500">*</span></label>
                <div class="mb-2">
                    <input id="city_municipality" type="text" required wire:model="city_or_municipality"
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>

                <label for="province" class="col-start-1">Province<span class="text-pink-500">*</span></label>
                <div class="mb-5">
                    <input id="province" type="text" required wire:model="province"
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                </div>
            </div>

            <div class="block">
                <div class="block text-slate-100 text-sm mt-5">
                    <input type="checkbox" id="certify" class="accent-pink-500" wire:model.live="certify">
                    <label for="certify">
                        I HEREBY CERTIFY that the information provided in this form is complete, true 
                        and correct to the best of my knowledge.
                    </label>
                </div>
    
                <div class="block mt-2">
                    <button type="submit" @if(!$certify) disabled data-tooltip-target="certify-tooltip" data-tooltip-placement="bottom" @endif
                    class="bg-blue-600 rounded p-2 hover:bg-blue-700 text-sm w-32
                    disabled:bg-gray-400">
                        <div wire:loading.remove>Submit</div>
                        <div class="inline-flex" wire:loading>
                            <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                </svg>
                                Loading...
                        </div>
                    </button>

                    <div id="certify-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Please certify that the above infomation is true before submiting
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
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

    @if ($verifying_email && !$email_verified)
    <div class="p-4 border border-slate-400 rounded bg-white bg-opacity-5 backdrop-blur-sm mx-auto text-slate-50 w-full md:w-1/2 shadow-lg">
        <h2 class="text-xl mb-5">Verify email</h2>
        <div class="flex justify-center">
            <div class="p-10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                  </svg>
            </div>
            <div class="mb-5">
                <h3 class="text-xl">Please check your email</h3>
                <h4 class="text-sm text-slate-400 mb-5">
                    We've sent the verification code to your email: <span class="text-pink-500">{{session()->get('form_data')['email']}}</span>
                    <br> 
                    Check your spam folder if you can't see the email
                </h4>

                <label for="code" class="col-start-1">Code</label>
                <div class="mb-2">
                    <input id="code" type="text" required autocomplete="off" wire:model="verification_code_input"
                    @error('verification') aria-invalid @enderror
                    class="border border-slate-400 bg-slate-600 rounded px-2 py-1 w-full
                    outline-blue-500
                    aria-[invalid]:border-pink-500
                    aria-[invalid]:border-2
                    ">
                    @error('verification') <span class="text-sm text-pink-500">{{$message}}</span> @enderror
                </div>

                <button wire:click="checkVerification()"
                    class="bg-blue-600 rounded p-2 hover:bg-blue-700 text-sm w-32
                    disabled:bg-gray-400">
                        <div wire:loading.remove>Submit</div>
                        <div class="inline-flex" wire:loading>
                            <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                </svg>
                                Loading...
                        </div>
                </button>
            </div>
        </div>
    </div>

    @endif

    @if ($email_verified)
    <div class="p-4 border border-slate-400 rounded bg-white bg-opacity-5 backdrop-blur-sm mx-auto text-slate-50 w-full md:w-1/2 shadow-lg flex justify-center">
        <div class="pe-10 flex items-center text-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
              </svg>              
        </div>
        <div class="flex items-center">
            <div>
                <h3 class="text-xl">Email verified!</h3>
                <h4 class="text-sm text-slate-400 mb-5">
                    Account created. You may now login.
                </h4>
                <a href="/">
                    <button wire:click="checkVerification()"
                    class="bg-blue-600 rounded py-2 px-4 hover:bg-blue-700 text-sm inline-flex items-center
                    disabled:bg-gray-400">
                        <div class="me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                          </svg>
                        </div>
                        <div>Go to login page</div>
                    </button>
                </a>
            </div>
        </div>
    </div>
    @endif
    
    @script
    <script type="module">
        new Datepicker($('#birthday')[0], {
            autohide: true,
            maxDate: new Date()
        }); 
    </script>
    @endscript
</div>
