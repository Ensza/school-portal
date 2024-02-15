<form table="{{$table}}" action="{{$action_url}}" method="{{$method}}" class="form-prevent-default my-3">
    @foreach ($inputs as $input)
        {!!$input->getHTML()!!}
    @endforeach
    @csrf
    <button type="submit" class="btn btn-success">Submit</button>
</form>