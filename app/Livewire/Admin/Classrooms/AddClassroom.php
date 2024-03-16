<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Classroom;
use App\Models\ClassroomSubject;
use App\Models\Curriculum;
use App\Models\Level;
use App\Models\Strand;
use Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddClassroom extends Component
{
    public Level $level;
    public $strands;
    public $classrooms;
    public $curricula;

    public $name = '';
    public $strand_id;
    public $subjects = [];
    public $curriculum_id;
    public $selected_curriculum;
    public $new_subject = '';
    public $classroom_created = false;

    public function mount(){
        $this->classrooms = $this->level->classrooms;
        $this->strands = Strand::all();
        $this->curricula = Curriculum::all();
    }
    
    public function updated(){
        if($this->curriculum_id){
            $this->selected_curriculum = Curriculum::find($this->curriculum_id);
        }
    }
    
    public function addCurriculumSubjectsToNewClass(){
        if($this->curriculum_id){
            $subjects = Curriculum::find($this->curriculum_id)->subjects;

            foreach($subjects as $subject){
                array_push($this->subjects, $subject->name);
            }
        }

        $this->curriculum_id = 0;
    }

    public function removeSubject(int $index){
        array_splice($this->subjects, $index, 1);
    }

    public function addNewSubject(){
        $this->validate([
            'new_subject'=>'required'
        ]);

        $this->subjects[] = $this->new_subject;
        $this->new_subject = '';
    }

    public function save(){
        $this->validate([
            'name'=>['required'],
            'strand_id'=>['required', Rule::exists('strands', 'id')],
        ]);

        if(Auth::user()->isAdmin()){
            //creating classroom in database
            $new_classroom = Classroom::create(
                array_merge($this->all(), [
                    'level_id' => $this->level->id
                ])
            );

            // adding subjects to database

            foreach($this->subjects as $subject){
                ClassroomSubject::create([
                    'name'=>$subject,
                    'classroom_id'=> $new_classroom->id
                ]);
            }

            // dispatch an event to refresh parent component
            $this->dispatch('classroom-created');
            $this->classroom_created = true;

            // reset variables
            $temp = $this->level;
            $this->reset();
            $this->level = $temp;
            $this->mount();
        }
    }

    public function render()
    {
        return view('livewire.admin.classrooms.add-classroom');
    }
}
