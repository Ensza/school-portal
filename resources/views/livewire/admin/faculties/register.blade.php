<div class="">

    <h1 class="text-lg mb-3">
        <a href="/admin/faculties" class="hover:text-blue-500" wire:navigate>
            Faculties
        </a>
        <span class="mx-1">/</span>
        <a href="/admin/faculties/register" class="text-blue-400 hover:text-blue-500" wire:navigate>
            Register
        </a>
    </h1>

    <div class="block rounded bg-white p-2 shadow md:px-10 py-4 relative overflow-clip" x-data="{ show_confirm : false }">
        <form wire:submit="submit()" class="">
            <h2 class="text-lg">Register a faculty member</h2>
        
            <div class="mt-5 grid grid-cols-2 md:grid-cols-4 gap-2 mx-auto lg:w-3/4">
                <span class="col-start-1 text-slate-800 text-lg my-2">Email</span>
    
                <label for="email" class="col-start-1">Email</label>
                <x-input id="email" model="email" modifier=".live" type="email" title="Email" placeholder="Email" class="mb-2" required />
    
                <span class="col-start-1 text-slate-800 text-lg my-2">Name</span>
    
                <label for="first-name" class="col-start-1">First name</label>
                <x-input id="first-name" model="first_name" title="First Name" placeholder="First name" required />
    
                <label for="middle-name" class="col-start-1">Middle name</label>
                <x-input id="middle-name" model="middle_name" title="Middle Name" placeholder="Middle name" />
                
                <label for="last-name" class="col-start-1">Last name</label>
                <x-input id="last-name" model="last_name" title="Last Name" placeholder="Last name" class="mb-2" required />
    
                <span class="col-start-1 text-slate-800 text-lg my-2">Birthday</span>
                
                <label for="birthday" class="col-start-1">Birthday</label>
                <x-input id="birthday" wire:focusout="$set('birthday', $event.target.value)" title="Birthday" placeholder="Birthday" class="mb-2" required />
    
                <span class="col-start-1 text-slate-800 text-lg my-2">Address</span>
    
                <label for="house-and-street" class="col-start-1">House and street</label>
                <x-input id="house-and-street" model="house_and_street" title="House and street" placeholder="House and street" required />
    
                <label for="city-municipality">City / Municipality</label>
                <x-input id="city-municipality" model="city_or_municipality" title="City / Municipality" placeholder="City / Municipality" required />
    
                <label for="province">Province</label>
                <x-input id="province" model="province" title="Province" placeholder="Province" required />
            </div>

            <div class="mt-10 block mx-auto lg:w-3/4">
                @if ($errors->any())
                <div class="block rounded bg-red-50 border border-red-500 p-4 mb-2 text-red-500">
                    There are errors in the form inputs, please fix the errors before submitting.
                </div>
                @endif

                @if ($registration_success)
                <div class="inline-flex w-full gap-3 items-center rounded bg-green-50 border border-green-500 p-4 mb-2 text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Registration success! You may go to the faculty section to see the profile.
                </div>
                @endif

                <button type="button" x-on:click="show_confirm = $('#email').val()"
                class="inline-block rounded px-4 py-1 bg-green-500 text-white hover:bg-green-600 cursor-pointer">
                Submit
                </button>
            </div>
            
            <div x-transition x-show="show_confirm" x-on:click="show_confirm = false" class="absolute top-0 left-0 w-full h-full bg-white bg-opacity-50 flex justify-center items-center">
                <div x-on:click.stop class="rounded p-4 bg-slate-50 border shadow text-center">
                    Are you sure this email is correct?
                    <h4 class="text-xl my-2 bg-slate-100 px-2 rounded">{{$email}}</h4>
                    <span class="text-yellow-600 block">Please make sure the email is correct, the system will send the account password to this email.</span>
                    <button x-on:click="show_confirm = false" type="submit" class="bg-green-500 rounded text-white shadow text-sm w-[15em] py-2 mt-5">The email is correct</button>
                    <br>
                    <button type="button" x-on:click="show_confirm = false" class="bg-red-500 rounded text-white shadow text-sm w-[15em] py-2 mt-2">The email is incorrect</button>
                </div>
            </div>

            <x-loader/>
        </form>
    </div>
    
    @script
    <script type="module">
        $("#faculties-register-link").attr('aria-selected', true);

        new Datepicker($('#birthday')[0], {
            autohide: true,
            maxDate: new Date()
        }); 
    </script>
    @endscript
</div>
