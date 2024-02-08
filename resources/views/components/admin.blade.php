<html>
    <head>
        <x-resources/>
        <script src="\resources\js\script.js"></script>
        <link rel="stylesheet" href="\resources\css\style.css">
    </head>
    <body class="d-flex m-0">

        <div id="sidebar" class="p-0" state="wide"
        style="
            min-width: 20em;
            width: 20em;
            background-image: url(/resources/img/background.jpg); 
            background-repeat: no-repeat; 
            background-position: center; 
            background-size: cover;
            box-shadow: inset 0 0 0 2000px rgba(0,0,0,0.75);">
            <div style="min-width: 20em;">
                <div class="row text-light p-2 mt-2">
                    <h2>Cainta Senior High School</h2>
                </div>
                <div class="p-2">
                    <div class="list-group">
                        <a href="/admin" id="dashboard-link" class="list-group-item list-group-item-action" aria-current="true">
                        Dashboard
                        </a>
                        <a href="/admin/tracks-and-strands" id="tracks-and-strands-link" class="list-group-item list-group-item-action">Tracks and Strands</a>
                        <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                        <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                        <a class="list-group-item list-group-item-action disabled">A disabled link item</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="main" class="w-100 p-0 d-flex flex-column mh-100 overflow-hidden" style="z-index: 2;background-color: #eeeeee">
            <div class="w-100 border-bottom p-2 d-flex shadow-sm bg-light" style="min-width: 400px">
                <div class="w-100 d-flex">
                    <button class="btn btn-primary" id="collapse-sidebar">col</button>
                </div>
                <div id="profile" class="me-3 py-1 px-2 d-flex align-items-center rounded" type="button" style="background-color: cornflowerblue">
                    <img id="profile-image" src="\resources\img\f.png" class="border border-1 rounded-circle" alt="" style="height: 30px; width: 30px">
                    <span id="profile-name" class="ms-2 text-light" style="user-select: none;">Admin</span>
                </div>
            </div>

            <div class="overflow-auto" style="min-width: 300px;">
                <div id="profile-panel" class="list-group me-4 shadow position-absolute end-0 d-none" style="min-width: 10em; z-index: 10">
                    <button class="btn btn-light">
                        Logout
                    </button>
                    <a href="/logout" class="btn btn-danger">
                        Logout
                    </a>
                </div>

                
                <div class="p-2 py-3">
                    {{$slot}}
                </div>

                
            </div>
        </div>
        <script>
            $(document).ready(function(){
                if ($(window).width() <= 800 && $('#sidebar').attr('state')=='wide') {
                    $('#sidebar')
                        .attr('state', 'collapsed')
                        .width(0)
                        .css("min-width", 0)
                }

                $('#collapse-sidebar').on('click',function(){
                    if($('#sidebar').attr('state')=='wide'){
                        $('#sidebar').animate({
                            width: 0,
                            "min-width": 0
                        },300,function(){
                            $('#sidebar').attr('state', 'collapsed')
                        });
                    }else{
                        $('#sidebar').animate({
                            "min-width": "20em",
                        },300,function(){
                            $('#sidebar').attr('state', 'wide')
                        });
                    }
                });

                $(window).on('resize', function(){
                    $('#sidebar').stop();
                    var win = $(this); //this = window
                    if (win.width() <= 800 && $('#sidebar').attr('state')=='wide') {
                        $('#collapse-sidebar').click();
                    }
                    
                    if(win.width() > 800 && $('#sidebar').attr('state')=='collapsed'){
                        $('#collapse-sidebar').click();
                    }
                });

                $("#profile").on("click", function() {
                    $("#profile-panel").toggleClass("d-none");
                });

                $(document).mouseup(function(e) {

                    if (!$("#profile-panel").is(e.target) 
                        && $("#profile-panel").has(e.target).length === 0
                        && !$("#profile").is(e.target) 
                        && !$("#profile-image").is(e.target) 
                        && !$("#profile-name").is(e.target) 
                    ) 
                    {
                        $("#profile-panel").addClass("d-none");
                    }
                });
            });
            </script>
            
            @stack('scripts')
    </body>
</html>