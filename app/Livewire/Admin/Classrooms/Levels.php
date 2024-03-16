<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Level;
use Livewire\Attributes\On;
use Livewire\Component;

class Levels extends Component
{
    public $levels;

    #[On('level-created')]
    public function mount(){
        $this->levels = Level::orderBy("name","asc")->get();
    }
    public function render()
    {
        return view('livewire.admin.classrooms.levels');
    }
}
