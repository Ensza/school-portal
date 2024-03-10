<div>
    <div class="grid lg:grid-cols-2 gap-4">
        @foreach ($tracks as $track)
            <livewire:admin.tracks-and-strands.track-card :$track :key="$track->id"/>
        @endforeach
    </div>
</div>
