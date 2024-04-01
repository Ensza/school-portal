@if (auth()->user()->isAdmin())

<x-layouts.admin>
    {{$slot}}
</x-layouts.admin>

@elseif (auth()->user()->isStudent())

<x-layouts.student>
    {{$slot}}
</x-layouts.student>
    
@endif
