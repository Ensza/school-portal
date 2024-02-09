<x-admin>
    
    <script>
        $("#tracks-and-strands-link").addClass("active");
    </script>

    <h1>Tracks and Strands</h1>
    <div id="tracks" class="p-2 shadow-sm rounded bg-light mt-4">
        <h2 class="fw-light">Tracks</h2>
        {!!$tracks_table!!}
        <div class="rounded border my-4 position-relative" style="background-color: #fff;">
            <div class="p-2">
                <h4 class="fw-light">Add new track</h4>
                <form id="add-track-form" action="add-track" method="POST" class="my-3">
                    <div class="row">
                        <div class="col-sm-5 mb-3">
                            <label for="track-name" class="form-label fw-bold">Track name</label>
                            <input type="text" class="form-control track-form" id="track-name" name="name" placeholder="Track name here" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 mb-3">
                            <label for="track-code" class="form-label fw-bold">Track code</label>
                            <input type="text" class="form-control track-form" id="track-code" name="code" placeholder="Unique code" required>
                            <span><i>Track code is a unique and short identifier for a track</i></span>
                        </div>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-success">Add track</button>
                </form>
                <div id="add-track-alert" class="alert alert-danger" role="alert" style="display: none">
                </div>
                <div id="add-track-alert-success" class="alert alert-success" role="alert" style="display: none">
                New track added!
                </div>
            </div>
            <x-loader id="add-track-loader"/>
        </div>
    </div>

    <div id="strands" class="p-2 shadow-sm rounded bg-light mt-2 mb-3">
        <h2 class="fw-light">Strands</h2>
        <div class="row m-0">
            <div class="col-sm-3 p-3">
                <h5>Filter by track</h5>
                <select class="form-select">
                    <option selected>All</option>
                    @foreach ($tracks as $track)
                    <option value="{{$track->code}}">{{$track->code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-9 p-3 overflow-auto">
                <div style="min-width: 600px">
                    <div class="row p-2 border-bottom">
                        <div class="col-4">
                            <span class="fw-bold">Strand name</span>
                        </div>
                        <div class="col-2">
                            <span class="fw-bold">Strand code</span>
                        </div>
                        <div class="col">
                            <span class="fw-bold">Track</span>
                        </div>
                    </div>
                    @foreach ($strands as $strand)
                    <div class="row p-2 border-bottom">
                        <div class="col-4 d-flex align-items-center">
                            {{$strand->name}}
                        </div>
                        <div class="col-2 d-flex align-items-center">
                            {{$strand->code}}
                        </div>
                        <div class="col-2 d-flex align-items-center">
                            awdw
                        </div>
                        <div class="col-4 border-start d-flex align-items-center justify-content-center">
                            <button class="btn btn-sm btn-primary m-1">Edit</button>
                            <button class="btn btn-sm btn-danger m-1">Delete</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="rounded border my-4 position-relative" style="background-color: #fff">
            <div class="p-2">
                <h4 class="fw-light">Add new strand</h4>
                <form id="add-strand-form" action="add-strand" method="POST" class="my-3">
                    <div class="row">
                        <div class="col-sm-5 mb-3">
                            <label for="strand-name" class="form-label fw-bold">Strand name</label>
                            <input type="text" class="form-control strand-form" id="strand-name" name="name" placeholder="strand name here" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 mb-3">
                            <label for="strand-code" class="form-label fw-bold">Strand code</label>
                            <input type="text" class="form-control strand-form" id="strand-code" name="code" placeholder="Unique code" required>
                            <span><i>Strand code is a unique and short identifier for a strand</i></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 mb-3">
                            <label for="track-id" class="form-label fw-bold">Track</label>
                            <select class="form-select strand-form" id="track-id" name="track_id">
                                @foreach ($tracks as $track)
                                <option value="{{$track->id}}">{{$track->code}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-success">Add strand</button>
                </form>
                <div id="add-strand-alert" class="alert alert-danger" role="alert" style="display: none">
                </div>
            </div>
            <x-loader id="add-strand-loader"/>
        </div>
    </div>

    <script>
        $("#add-track-form").on('submit', function(e){
            e.preventDefault();
            $('#add-track-loader').removeClass('d-none').addClass('d-flex');
            
            var form = $(this);
            var actionUrl = form.attr('action');
            
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data.is_invalid){
                        var errors_list = '';
                        Object.entries(data.errors).forEach(error => {
                            errors_list+=`<li>${error[1]}</li>`; //create errors html list
                            $(`.track-form:input[name='${error[0]}']`).addClass('is-invalid');
                        });
                        $('#add-track-loader').removeClass('d-flex').addClass('d-none');
                        $('#add-track-alert').html(errors_list).show();
                    }else{
                        $('#add-track-loader').removeClass('d-flex').addClass('d-none');
                        $('#add-track-alert-success').show();
                        $('#reload-tracks-btn').click();
                    }
                    
                }
            });
        });

        $("#add-strand-form").on('submit', function(e){
            e.preventDefault();
            $('#add-strand-loader').removeClass('d-none').addClass('d-flex');
            
            var form = $(this);
            var actionUrl = form.attr('action');
            
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data.is_invalid){
                        var errors_list = '';
                        Object.entries(data.errors).forEach(error => {
                            errors_list+=`<li>${error[1]}</li>`; //create errors html list
                            $(`.strand-form:input[name='${error[0]}']`).addClass('is-invalid');
                        });
                        $('#add-strand-loader').removeClass('d-flex').addClass('d-none');
                        $('#add-strand-alert').html(errors_list).show();
                    }else{
                        window.location.reload(true);
                    }
                    
                }
            });
        });
    </script>
</x-admin>