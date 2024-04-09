<?php

namespace App\Livewire\Student\Classrooms;

use App\Models\StudentProfile;
use Auth;
use Livewire\Component;

class MyClassroom extends Component
{
    public StudentProfile $profile;

    public function mount(){
        $this->profile = Auth::user()->profile;
    }

    public function render()
    {
        return view('livewire.student.classrooms.my-classroom');
    }
}
