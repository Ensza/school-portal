<div class="flex items-center h-screen m-0">
    <div class="grid md:grid-flow-col grid-flow-row w-full p-1 lg:p-10">
        <div class="py-5 flex flex-col lg:justify-center text-white">
            <h1 class="fw-bold text-light mx-5" style="font-size: 4em">Welcome to School Portal</h1>
            <h2 class="text-light mx-5">School subtitle</h2>
        </div>
        <div>
            <div class="p-3 h-full flex flex-col justify-center">
                <div class="border border-white border-opacity-30 text-white bg-white bg-opacity-5 backdrop-blur-sm rounded p-4 shadow-lg overflow-clip">
                    <h3 class="text-xl">Login</h3>
                    <form class="mt-3" wire:submit="login()">
                        <div class="mb-3">
                            <input type="text" class="text-slate-700 w-full p-2 rounded border outline-blue-500" id="email" name="email"
                            wire:model="email">
                            <label for="email" class="text-sm" type="email" required>Email</label>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="text-slate-700 w-full p-2 rounded border outline-blue-500" id="password" name="password"
                            wire:model="password">
                            <label for="password" class="text-sm" required>Password</label>
                        </div>
                        <div class="flex items-center mb-4">
                            <input id="rememberme" type="checkbox" name="rememberme" 
                            class="w-4 h-4 border rounded border-white accent-blue-500 focus:ring-1 ring-blue-500 ring-offset-1" 
                            wire:click="$toggle('remember_me')">
                            <label for="rememberme" class="ms-2 text-sm font-medium text-gray-300">Remember me</label>

                            <a wire:navigate href="register" class="ms-auto text-sm text-slate-200 hover:text-blue-400">Don't have an account?</a>
                        </div>
                        
                        @csrf

                        <div class="mt-3">
                            <button class="transition rounded-full bg-blue-600 text-white py-2 px-3 hover:bg-blue-800 text-sm" type="submit">Login</button>
                        </div>
                    </form>
                    @if($errors->any())
                        <div class="p-3 block border border-red-500 bg-red-100 text-red-500 rounded mt-2 text-sm" role="alert">
                        @foreach ($errors->all() as $item) 
                            <li>{{$item}}</li>
                        @endforeach
                        </div>
                    @endif
                    
                    {{-- loader div --}}
                    <x-loader/>
                </div>
            </div>
        </div>
    </div>
    
</div>
