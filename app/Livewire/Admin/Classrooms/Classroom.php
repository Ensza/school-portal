<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Classroom as ModelsClassroom;
use App\Models\Curriculum;
use App\Models\Strand;
use Livewire\Component;

class Classroom extends Component
{
    public ModelsClassroom $classroom;
    public $strands;
    public $curricula;

    public $name = '';
    public $strand_id = '';
    public $subjects;
    public $new_subject = '';

    public $curriculum_id;
    public Curriculum $selected_curriculum;
    
    public $classroom_created = false;

    public function mount(){
        $this->strands = Strand::all();
        $this->curricula = Curriculum::all();
        $this->subjects = $this->classroom->subjects;
        $this->name = $this->classroom->name;
        $this->strand_id = $this->classroom->strand_id;
    }

    public function updated(){
        if($this->curriculum_id){
            $this->selected_curriculum = Curriculum::find($this->curriculum_id);
        }

        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.classrooms.classroom');
    }
}
