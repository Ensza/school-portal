@if (auth()->user()->isAdmin())

<x-admin>
    {{$slot}}
</x-admin>
    
@endif
