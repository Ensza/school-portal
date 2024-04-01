<?php

namespace App\Livewire\Student\Classrooms;

use App\Models\Classroom;
use Livewire\Component;

class ClassroomGridButton extends Component
{
    public Classroom $classroom;
    public $selected = false;
    public function render()
    {
        return view('livewire.student.classrooms.classroom-grid-button');
    }
}
