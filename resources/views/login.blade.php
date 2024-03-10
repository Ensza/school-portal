<html>
    <head>
        <x-resources/>
    </head>
    <body class="">
        <div class="flex items-center h-screen m-0" 
        style="
            background-image: url(resources/img/background.jpg); 
            background-repeat: no-repeat; 
            background-position: center; 
            background-size: cover;
            box-shadow: inset 0 0 0 2000px rgba(0,0,0,0.5);">
            <div class="grid md:grid-flow-col grid-flow-row w-full p-1 lg:p-10">
                <div class="py-5 flex flex-col lg:justify-center text-white">
                    <h1 class="fw-bold text-light mx-5" style="font-size: 4em">Welcome to School Portal</h1>
                    <h2 class="text-light mx-5">School subtitle</h2>
                </div>
                <div>
                    <div class="p-3 h-full flex flex-col justify-center">
                        <div class="border border-white border-opacity-30 text-white backdrop-blur-md rounded p-4 shadow">
                            <h3 class="text-lg">Login</h3>
                            <form class="mt-3" action="" method="POST">
                                <div class="mb-3">
                                    <input type="text" class="text-black w-full p-2 rounded border" id="username" name="username">
                                    <label for="username" class="font-semibold">Username</label>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="text-black w-full p-2 rounded border" id="password" name="password">
                                    <label for="password" class="font-semibold">Password</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="rememberme" type="checkbox" value="rememberme" name="rememberme" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="rememberme" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                                </div>
                                
                                @csrf
                                <div class="mt-3">
                                    <button class="transition rounded bg-blue-600 text-white py-2 px-3 hover:bg-blue-800" type="submit">LOGIN</button>
                                </div>
                            </form>
                            <div class="">
                                @if($errors->any())
                                    <div class="p-3 border-red-400 bg-red-200 text-red-900 rounded" role="alert">
                        
                                    @foreach ($errors->all() as $item) 
                                        <span class="w-full">{{$item}}</span>
                                    @endforeach

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </body>
</html>