<html>
    <head>
        <x-resources/>
    </head>
    <body class="">
        <div class="row min-vh-100 m-0" 
        style="
            background-image: url(resources/img/background.jpg); 
            background-repeat: no-repeat; 
            background-position: center; 
            background-size: cover;
            box-shadow: inset 0 0 0 2000px rgba(0,0,0,0.75);">
            <div class="col-md-8 py-5 d-flex flex-column justify-content-center">
                <h1 class="fw-bold text-light mx-5" style="font-size: 4em">Welcome to School Portal</h1>
                <h2 class="text-light mx-5">School subtitle</h2>
            </div>
            <div class="col-md-4 p-3">
                <div class="p-3 h-100 d-flex flex-column justify-content-center">
                    <div class="card p-3">
                        <h3>Login</h3>
                        <form class="mt-3" action="" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="username" name="username">
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password">
                                <label for="password">Password</label>
                            </div>
                            <label class="mt-2">
                                <input type="checkbox" name="rememberme">
                                <span>Remember me</span>
                            </label>
                            
                            @csrf
                            <div class="mt-3">
                                <button class="btn btn-primary w-100" type="submit">LOGIN</button>
                            </div>
                        </form>
                        <div class="">
                            @if($errors->any())
                                <div class="alert alert-warning" role="alert">
                    
                                @foreach ($errors->all() as $item) 
                                    <span>{{$item}}</span>
                                @endforeach

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>