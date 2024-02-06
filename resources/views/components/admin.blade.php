<html>
    <head>
        <x-resources/>
        <script src="resources\js\script.js"></script>
        <link rel="stylesheet" href="resources\css\style.css">
    </head>
    <body class="d-flex m-0">

        <div id="sidebar" class="p-0" state="wide"
        style="
            min-width: 20em;
            width: 20em;
            background-image: url(resources/img/background.jpg); 
            background-repeat: no-repeat; 
            background-position: center; 
            background-size: cover;
            box-shadow: inset 0 0 0 2000px rgba(0,0,0,0.75);">
            <div style="min-width: 20em;">
                <div class="row text-light p-2">
                    <h2>Cainta Senior High School</h2>
                </div>
                <div class="p-2">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                        The current link item
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                        <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                        <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                        <a class="list-group-item list-group-item-action disabled">A disabled link item</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="main" class="w-100 p-0 d-flex flex-column mh-100 overflow-hidden" style="z-index: 2;background-color: #eeeeee">
            <div class="w-100 border-bottom p-2 d-flex">
                <div class="w-100 d-flex">
                    <button class="btn btn-primary" id="collapse-sidebar">col</button>
                </div>
                <div class="me-3 px-2 d-flex align-items-center rounded" type="button" style="background-color: cornflowerblue">
                    <img src="resources\img\f.png" class="border border-1 rounded-circle" alt="" style="height: 30px; width: 30px">
                    <span class="ms-2 text-light">Admin</span>
                </div>
            </div>
            <div class="overflow-auto p-2" style="min-width: 400px">
                {{$slot}}
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
            });
            </script>
    </body>
</html>