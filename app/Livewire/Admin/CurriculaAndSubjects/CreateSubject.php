<?php

namespace App\Livewire\Admin\CurriculaAndSubjects;

use App\Models\Subject;
use Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateSubject extends Component
{
    
    #[Validate]
    public $name = '';

    #[Validate]
    public $curriculum_id;

    public function rules(){
        return [
            'name'=>'required',
            'curriculum_id'=>['required', Rule::exists('curricula', 'id')]
        ];
    }

    public function create(){
        $this->validate();

        if(Auth::user()->isAdmin()){
            Subject::create(['name'=>$this->name,'curriculum_id'=>$this->curriculum_id]);
        }

        $this->name='';

        $this->dispatch('subject-created');
    }

    public function render()
    {
        return view('livewire.admin.curricula-and-subjects.create-subject');
    }
}
