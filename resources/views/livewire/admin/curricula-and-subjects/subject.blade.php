<div class="block border-b p-2 text-slate-700 subject" row-id="{{$subject->id}}">
    <span>{{$subject->name}}</span>
</div>
@script
<script type="module">
    $('.subject[row-id="{{$subject->id}}"]').hide().fadeIn('fast');
</script>
@endscript
