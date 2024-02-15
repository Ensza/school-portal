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
                <form table="tracks" action="/admin/tracks/create" method="POST" class="form-prevent-default my-3">
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
                <div id="tracks-add-alert" class="alert alert-danger" role="alert" style="display: none">
                </div>
                <div id="tracks-add-alert-success" class="alert alert-success" role="alert" style="display: none">
                New track added!
                </div>
            </div>
            <x-loader id="tracks-add-loader"/>
        </div>
    </div>

    <div id="strands" class="p-2 shadow-sm rounded bg-light mt-2 mb-3">
        <h2 class="fw-light">Strands</h2>
        {!!$strands_table!!}
        <div class="rounded border my-4 position-relative" style="background-color: #fff">
            <div class="p-2">
                <h4 class="fw-light">Add new strand</h4>
                <form table="strands" action="/admin/strands/create" method="POST" class="form-prevent-default my-3">
                    <div class="row">
                        <div class="col-sm-5 mb-3">
                            <label for="strand-name" class="form-label fw-bold">Strand name</label>
                            <input type="text" class="form-control strand-form" id="strand-name" name="name" placeholder="Strand name here" required>
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
                            <select class="form-select strand-form" id="track-select" name="track_id">
                                @foreach ($tracks as $track)
                                <option value="{{$track->id}}">{{$track->code}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-success">Add strand</button>
                </form>
                <div id="strands-add-alert" class="alert alert-danger" role="alert" style="display: none">
                </div>
                <div id="strands-add-alert-success" class="alert alert-success" role="alert" style="display: none">
                    New strand added!
                </div>
            </div>
            <x-loader id="strands-add-loader"/>
        </div>
    </div>

    <script>
        // add track form or add strand submit listener
        $(".form-prevent-default").on('submit', function(e){
            e.preventDefault();
            let table = $(this).attr('table');
            add_row(table, $(this), function(data){

                if(table == 'tracks'){
                    if(!data.is_invalid){
                        let tracks_options = '';
                        data.tracks.forEach(track => {
                            tracks_options += `<option value="${track.id}">${track.code}</option>`;
                        });
                        $('#track-select').html(tracks_options);
                    }
                }

                if(table == 'strands'){
                    if(!data.is_invalid){
                        $('#reload-tracks-btn').click();
                    }
                }
            });
            
        });
       
        // tracks edit button listener
        $('table').on('click', '.tracks-edit-button',function(e){
            e.stopPropagation()
            let table = 'tracks';
            let row_id = $(this).attr('row-id');
            let row = $(`#${table}-id-${row_id}`);
            
            $(`.${table}-table-button`).prop('disabled', true);
            $(this).html(`<div class="spinner-border" role="status" style="width: 1.5em; height: 1.5em;"></div>`)
                .attr('disabled','true');
            $.get(`/admin/${table}/edit-row?id=${row_id}`, function(data, status){ // get row html
                row.html(data);
            });
        });

        $('table').on('click','.tracks-edit-cancel',function(e){
            e.stopPropagation();
            $(this).prop('disabled', true);
            $('#reload-tracks-btn').click();
        });

        $('table').on('click','.tracks-edit-confirm',function(e){
            e.stopPropagation();
            let table = 'tracks';
            let row_id = $(this).attr('row-id');
            let name = $('#edit-track-name').val();
            let code = $('#edit-track-code').val();
            $('#tracks-table_processing').show();
            $(this).prop('disabled', true);
            $.get(`/admin/${table}/edit-row?id=${row_id}&confirm=1&name=${name}&code=${code}`, function(data, status){ // get row html
                if(data.is_invalid){
                    $('#tracks-table_processing').hide();
                    $(this).prop('disabled', false);
                    Object.entries(data.errors).forEach(error => {
                        $(`#edit-track-${error[0]}`).addClass('is-invalid');
                    });
                }else{
                    let tracks_options = '';
                    data.tracks.forEach(track => {
                        tracks_options += `<option value="${track.id}">${track.code}</option>`;
                    });
                    $('#track-id').html(tracks_options);
                    $('#reload-strands-btn').click();
                    $('#reload-tracks-btn').click();
                }
            });
        });
        
        // delete track button
        $('table').on('click', '.tracks-delete-button',function(e){
            e.stopPropagation();
            let row_id = $(this).attr('row-id');
            let action_column = $(this).parent().parent();
            action_column.html(
                `<button class="btn btn-sm btn-danger m-1 tracks-delete-confirm" row-id="${row_id}">DELETE</button>
                <button class="btn btn-sm btn-primary m-1 tracks-delete-cancel" row-id="${row_id}">Cancel</button>
                </br><span class="fs-6">Confirm delete</span>
                `
            )
        });

        $('table').on('click', '.tracks-delete-cancel', function(e){
            e.stopPropagation();
            $(this).prop('disabled', true);
            $('#reload-tracks-btn').click();
        });

        $('table').on('click', '.tracks-delete-confirm', function(e){
            e.stopPropagation();
            let row_id = $(this).attr('row-id');
            delete_row('tracks', row_id, $(this), function(data){
                if(!data.is_invalid){
                    $(`#track-select option[value=${row_id}]`).remove();
                }
            });
        });

        // strands edit button listener
        $('table').on('click', '.strands-edit-button',function(e){
            e.stopPropagation()
            let table = 'strands';
            let row_id = $(this).attr('row-id');
            let row = $(`#${table}-id-${row_id}`);

            $(`.${table}-table-button`).prop('disabled', true);
            $(this).html(`<div class="spinner-border" role="status" style="width: 1.5em; height: 1.5em;"></div>`)
                .attr('disabled','true');
            $.get(`/admin/${table}/edit-row?id=${row_id}`, function(data, status){ // get row html
                row.html(data);
            });
        });

        $('table').on('click','.strands-edit-cancel',function(e){
            e.stopPropagation();
            $(this).prop('disabled', true);
            $('#reload-strands-btn').click();
        });

        $('table').on('click','.strands-edit-confirm',function(e){
            e.stopPropagation();
            let table = 'strands';
            let row_id = $(this).attr('row-id');
            let name = $('#edit-strand-name').val();
            let code = $('#edit-strand-code').val();
            let track_id = $('#edit-strand-track_id').val();
            $('#strands-table_processing').show();
            $(this).prop('disabled', true);
            $.get(`/admin/${table}/edit-row?id=${row_id}&confirm=1&name=${name}&code=${code}&track_id=${track_id}`, function(data, status){ // get row html
                if(data.is_invalid){
                    $('#strands-table_processing').hide();
                    $(this).prop('disabled', false);
                    Object.entries(data.errors).forEach(error => {
                        $(`#edit-strand-${error[0]}`).addClass('is-invalid');
                    });
                }else{
                    $('#reload-strands-btn').click();
                    $('#reload-tracks-btn').click();
                }
            });
        });
        
        // delete strands button
        $('table').on('click', '.strands-delete-button',function(e){
            e.stopPropagation();
            let row_id = $(this).attr('row-id');
            let action_column = $(this).parent().parent();
            action_column.html(
                `<button class="btn btn-sm btn-danger m-1 strands-delete-confirm" row-id="${row_id}">DELETE</button>
                <button class="btn btn-sm btn-primary m-1 strands-delete-cancel" row-id="${row_id}">Cancel</button>
                </br><span class="fs-6">Confirm delete</span>
                `
            )
        });

        $('table').on('click', '.strands-delete-cancel', function(e){
            e.stopPropagation();
            $(this).prop('disabled', true);
            $('#reload-strands-btn').click();
        });

        $('table').on('click', '.strands-delete-confirm', function(e){
            e.stopPropagation();
            delete_row('strands', $(this).attr('row-id'), $(this));
        });









        

        function add_row(table, form, ajax_callback){ // make sure to pass the form jquery($) element as the second argument. The 'ajax_callback' is called inside the success callback, the 'data' variable is passed as argument
            $(`#${table}-add-loader`).removeClass('d-none').addClass('d-flex');
            $(`#${table}-add-alert`).hide();
            $(`#${table}-add-alert-success`).hide();
            
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
                            $(`.form-prevent-default[table="${table}"] input[name='${error[0]}']`).addClass('is-invalid');
                        });
                        $(`#${table}-add-loader`).removeClass('d-flex').addClass('d-none');
                        $(`#${table}-add-alert`).html(errors_list).show();
                    }else{
                        $(`#${table}-add-loader`).removeClass('d-flex').addClass('d-none');
                        $(`#${table}-add-alert-success`).show();
                        $(`#reload-${table}-btn`).click();
                    }

                    if(ajax_callback){
                        ajax_callback(data);
                    }
                }
            });
        }

        function delete_row(table, id, button, ajax_callback){
            button.prop('disabled', true);
            $(`#${table}-table_processing`).show();

            let row = button.parent().parent();

            $.get(`/admin/${table}/delete?id=${id}`,function(data,status){
                $(`#${table}-table_processing`).hide();
                if(data.is_invalid){
                    button.prop('disabled', false);
                    alert('something went wrong');
                }else{
                    row.animate({
                        opacity: 0
                    }, 500, function() {
                        $(`#reload-${table}-btn`).click();
                    });
                }

                if(ajax_callback){
                    ajax_callback(data);
                }
            });
        }

    </script>
</x-admin>