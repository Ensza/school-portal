<?php

namespace App\Livewire\Student\Classrooms;

use App\Models\Classroom as ModelsClassroom;
use Auth;
use Livewire\Component;

class Classroom extends Component
{
    public ModelsClassroom $classroom;
    public $enable_close_button = true;

    public function mount(){

    }

    public function updated(){

    }

    public function enroll(){
        
        $profile = Auth::user()->profile;

        if(Auth::user()->profile->is_enrolled){
            return;
        }

        if(!Auth::user()->profile->classroom_id){
            $profile->classroom_id = $this->classroom->id;
            $profile->save();

            return;
        }
        
        $profile->classroom_id = 0;
        $profile->save();

    }

    public function render()
    {
        return view('livewire.student.classrooms.classroom');
    }
}
