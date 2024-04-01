<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Classroom as ModelsClassroom;
use App\Models\ClassroomSubject;
use App\Models\Curriculum;
use App\Models\Profile;
use App\Models\Strand;
use Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Classroom extends Component
{
    public ModelsClassroom $classroom;
    public $students;
    public $pending_students;

    public $strands;
    public $curricula;
    public $subjects;

    public $name = '';
    public $strand_id = '';
    public $new_subject = '';

    public $curriculum_id;
    public Curriculum $selected_curriculum;
    
    public $editing = false;
    public $sort_students_by;
    public $sort_pending_students_by;

    public string $search_students = '';

    public function mount(){
        $this->strands = Strand::all();
        $this->curricula = Curriculum::all();
        $this->subjects = $this->classroom->subjects;
        $this->name = $this->classroom->name;
        $this->strand_id = $this->classroom->strand_id;

        $this->updateStudentsCollection();

        $this->sortStudents('last_name');
        $this->sortPendingStudents('last_name');
    }

    public function updated(){
        if($this->curriculum_id){
            $this->selected_curriculum = Curriculum::find($this->curriculum_id);
        }
    }

    public function updateStudentsCollection(){
        if(Auth::user()->isAdmin()){
            $students = $this->classroom->students->where(function($m){
                return $m->user->role;
            }, 'student');

            $this->students = $students->where('is_enrolled', true);
            $this->pending_students = $students->where('is_enrolled', false);
        }
    }

    public function admit(int $id){
        $student = Profile::find($id);

        if(Auth::user()->isAdmin()){
            if($student->user->isStudent() && !$student->is_enrolled && $student->classroom_id == $this->classroom->id){
                $student->is_enrolled = true;
                $student->save();

                $this->updateStudentsCollection();
            }
        }
    }

    public function filterStudents(){
        $this->updateStudentsCollection();

        $this->search_students = strtolower($this->search_students);

        $this->students = $this->students->filter(function($m) {
            return 
            false !== strpos(strtolower($m->first_name), $this->search_students) ||
            false !== strpos(strtolower($m->middle_name), $this->search_students) ||
            false !== strpos(strtolower($m->last_name), $this->search_students) ||
            false !== strpos(strtolower($m->user->email), $this->search_students) ||
            false !== strpos(strtolower($m->first_name.' '.$m->last_name), $this->search_students);
        });

        $this->sortStudents($this->sort_students_by);
    }

    public function sortStudents($sort_by){
        $this->sort_students_by = $sort_by;

        $this->validate([
            'sort_students_by' => Rule::in([
                'name',
                'first_name',
                'middle_name',
                'last_name',
                'email'
            ])
        ]);

        switch ($sort_by) {
            case 'name':
                $this->students = $this->students->sortBy(function($m){
                    return strtolower($m->first_name.' '.$m->middle_name.' '.$m->last_name);
                });
                break;
            case 'first_name':
                $this->students = $this->students->sortBy(function($m){
                    return strtolower($m->first_name);
                });
                break;
            case 'middle_name':
                $this->students = $this->students->sortBy(function($m){
                    return strtoupper($m->middle_name);
                });
                break;
            case 'last_name':
                $this->students = $this->students->sortBy(function($m){
                    return strtolower($m->last_name);
                });
                break;
            case 'email':
                $this->students = $this->students->sortBy(function($m){
                    return strtolower($m->user->email);
                });
        }
    }

    public function sortPendingStudents($sort_by){
        $this->sort_pending_students_by = $sort_by;

        $this->validate([
            'sort_pending_students_by' => Rule::in([
                'name',
                'first_name',
                'middle_name',
                'last_name',
                'email'
            ])
        ]);

        switch ($sort_by) {
            case 'name':
                $this->pending_students = $this->pending_students->sortBy(function($m){
                    return strtolower($m->first_name.' '.$m->middle_name.' '.$m->last_name);
                });
                break;
            case 'first_name':
                $this->pending_students = $this->pending_students->sortBy(function($m){
                    return strtolower($m->first_name);
                });
                break;
            case 'middle_name':
                $this->pending_students = $this->pending_students->sortBy(function($m){
                    return strtoupper($m->middle_name);
                });
                break;
            case 'last_name':
                $this->pending_students = $this->pending_students->sortBy(function($m){
                    return strtolower($m->last_name);
                });
                break;
            case 'email':
                $this->pending_students = $this->pending_students->sortBy(function($m){
                    return strtolower($m->user->email);
                });
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
        if(!$this->curriculum_id){
            return;
        }

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

        $this->dispatch('classroom-updated');
    }

    public function render()
    {
        return view('livewire.admin.classrooms.classroom');
    }
}
