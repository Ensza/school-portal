<?php

namespace App\Livewire\Admin\CurriculaAndSubjects;

use App\Models\Subject as ModelsSubject;
use Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Subject extends Component
{
    public ModelsSubject $subject;

    #[Validate('required')]
    public $name = '';

    public $editing = false;
    public $deleted = false;

    public function mount(){
        $this->name = $this->subject->name;
    }

    public function edit(){
        $this->validate();
        if(Auth::user()->isAdmin()){
            if($this->subject->exists()){
                $this->subject->name = $this->name;

                $this->subject->save();
            }
        }

        $this->editing = false;
    }

    public function toggleEditing(){
        $this->name = $this->subject->name;

        $this->editing = true;
    }

    public function delete(){
        if(Auth::user()->isAdmin()){
            if($this->subject->exists()){
                $this->subject->delete();
            }
        }

        $this->deleted = true;
    }

    public function render()
    {
        return view('livewire.admin.curricula-and-subjects.subject');
    }
}
