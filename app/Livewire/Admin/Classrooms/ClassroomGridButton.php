<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Classroom;
use Livewire\Component;

class ClassroomGridButton extends Component
{
    public Classroom $classroom;
    public $selected = false;
    public function render()
    {
        return view('livewire.admin.classrooms.classroom-grid-button');
    }
}
