<div class="{{$class ?? ''}}">
    <input type="text" 
    class="px-2 block py-0.5 border rounded bg-slate-50 outline-slate-600 aria-[invalid]:border-red-500 
    aria-[invalid]:outline-red-500 w-full" 

    {{$attributes}}

    @if ($model ?? false)
        wire:model{{$modifier ?? ''}}='{{$model ?? ''}}'
    @endif
    @error($model ?? false)
        aria-invalid="true"
    @enderror
    >
    @error($model ?? false)
        <span class="text-sm text-red-500 mt-0">{{$message}}</span>
    @enderror
</div>