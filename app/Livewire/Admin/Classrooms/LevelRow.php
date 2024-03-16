<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Classroom;
use App\Models\Level;
use Livewire\Component;

class LevelRow extends Component
{
    public Level $level;
    public $classrooms;


    public Classroom $selected_classroom;

    public $creating_classroom = false;

    public function mount(){
        $this->classrooms = $this->level->classrooms;
    }

    // define selected classroom upon clicking
    public function selectClassroom(int $id){
        $this->selected_classroom = Classroom::find( $id );

        // if selected classroom is not null
        if($this->selected_classroom){
            $this->closeAddClassroom();
        }
        
    }

    public function unsetSelectedClassroom(){
        unset($this->selected_classroom);
    }

    public function openAddClassroom(){
        $this->unsetSelectedClassroom();
        $this->creating_classroom = true;
    }

    public function closeAddClassroom(){
        $this->creating_classroom = false;
    }
    
    public function render()
    {
        return view('livewire.admin.classrooms.level-row');
    }
}
