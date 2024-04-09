<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Classroom;
use App\Models\Level;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LevelRow extends Component
{
    public Level $level;
    public $classrooms;

    #[Validate]
    public $sort_by = 'strand';


    public Classroom $selected_classroom;

    public $creating_classroom = false;

    public function rules(){
        return [
            'sort_by'=>Rule::in([
                'id',
                'name',
                'strand'
            ])
        ];
    }

    public function mount(){
        $this->sortClassrooms();
    }
    
    #[Computed]
    public function classrooms_by_strand(){
        $classrooms = $this->level->classrooms->load('strand');
        // sort by name first, then group by strand, then sort the group by strand name (keys) then finally collapse the collection to a single array
        return $classrooms->sortBy(function($m){
            return strtolower($m->name);
        })->groupBy(['strand.name'])->sortKeys();
    }

    public function sortClassrooms(){
        $classrooms = $this->level->classrooms->load('strand');
        
        if($this->sort_by == 'id'){
            $classrooms = $classrooms->sortBy('id');
        }elseif($this->sort_by == 'name'){
            $classrooms = $classrooms->sortBy(function($m){
                return strtolower($m->name);
            });
        }

        $this->classrooms = $classrooms;
    }

    // define selected classroom upon clicking
    public function selectClassroom(int $id){
        $this->selected_classroom = Classroom::find( $id );

        // if selected classroom is not null, close the add classroom panel
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
    
    #[On('classroom-created')]
    public function classroomCreated($id){
        $this->selected_classroom = Classroom::find( $id );
        $this->creating_classroom = false;
        $this->sort_by = 'id';
        $this->sortClassrooms();
    }
    
    #[On('classroom-updated')]
    public function render()
    {
        return view('livewire.admin.classrooms.level-row');
    }
}
