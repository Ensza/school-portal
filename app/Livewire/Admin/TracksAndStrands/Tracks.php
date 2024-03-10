<?php

namespace App\Livewire\Admin\TracksAndStrands;

use App\Models\Track;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Tracks extends Component
{
    public Collection $tracks;

    public function mount(){
        $this->tracks = Track::all();
    }

    #[On('track-deleted')]
    #[On('track-created')]
    public function trackUpdate(){
        $this->tracks = Track::all();
    }

    public function render()
    {
        return view('livewire.admin.tracks-and-strands.tracks');
    }
}
