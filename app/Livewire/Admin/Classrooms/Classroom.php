<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Classroom as ModelsClassroom;
use App\Models\ClassroomSubject;
use App\Models\Curriculum;
use App\Models\Strand;
use Auth;
use Livewire\Component;

class Classroom extends Component
{
    public ModelsClassroom $classroom;
    public $strands;
    public $curricula;
    public $subjects;

    public $name = '';
    public $strand_id = '';
    public $new_subject = '';

    public $curriculum_id;
    public Curriculum $selected_curriculum;
    public $selected_tab = 'subjects';
    
    public $editing = false;

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
    }

    public function deleteSubject(int $id){
        if($this->subjects->find($id)){
            $this->subjects->find($id)->delete();
        }
        // re-assign the values of the subjects variable to force refresh the table in the view
        $this->subjects = $this->classroom->subjects;
    }

    public function addNewSubject(){
        $new_sub = ClassroomSubject::create([
            'name'=>$this->new_subject,
            'classroom_id'=>$this->classroom->id,
        ]);
        
        $this->subjects->add($new_sub);

        $this->new_subject = '';
    }

    public function addCurriculumSubjectsToClassroom(){
        foreach($this->selected_curriculum->subjects as $subject){
            ClassroomSubject::create([
                'name'=> $subject->name,
                'classroom_id'=> $this->classroom->id,
            ]);
        }

        // re-assign the values of the subjects variable to force refresh the table in the view
        $this->subjects = $this->classroom->subjects;

        $this->curriculum_id = 0;
    }

    public function save(){
        $this->validate([
            'name'=>'required',
            'strand_id'=> 'required|exists:strands,id',
        ]);

        if(!Auth::user()->isAdmin()){
            return;
        }

        $this->classroom->name = $this->name;
        $this->classroom->strand_id = $this->strand_id;
        $this->classroom->save();

        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.admin.classrooms.classroom');
    }
}
