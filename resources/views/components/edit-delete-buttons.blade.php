<button class="btn btn-sm btn-warning m-1 {{$table_name}}-table-button {{$table_name}}-edit-button" row-id="{{$row_id}}" {!!$edit_attr!!}>Edit</button>
<span class="{{$disabled ? "$table_name-delete-disabled" : ''}}" tabindex="0" data-bs-toggle="tooltip" data-bs-title="{{$tooltip_message}}">
    <button class="btn btn-sm btn-danger m-1 {{$table_name}}-table-button {{$table_name}}-delete-button" row-id="{{$row_id}}" {!!$del_attr!!} 
    {{$disabled ? "disabled" : ""}}
    >Delete</button>
</span>
<script>
    {!!$script!!}
</script>
