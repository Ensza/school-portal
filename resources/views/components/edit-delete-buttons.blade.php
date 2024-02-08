<button class="btn btn-sm btn-warning m-1 {{$table_name}}" row-id="{{$track->id}}">Edit</button>
<button class="btn btn-sm btn-danger m-1 {{$table_name}}" row-id="{{$track->id}}"
    @if($track->strands->count()>0)
        disabled
    @endif
    >Delete</button>