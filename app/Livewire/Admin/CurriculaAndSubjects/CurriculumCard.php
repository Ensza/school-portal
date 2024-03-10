<?php

namespace App\Livewire\Admin\CurriculaAndSubjects;

use App\Models\Curriculum;
use App\Models\Strand;
use Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CurriculumCard extends Component
{
    public Curriculum $curriculum;
    public $strands;

    #[Validate]
    public $name = '';
    #[Validate]
    public $strand_id;
    
    public $editing = false;
    public $deleted = false;

    public function mount(){
        $this->name = $this->curriculum->name;
        $this->strand_id = $this->curriculum->strand_id;
        $this->strands = Strand::all();
    }

    public function rules(){
        return [
            'name'=> ['required'],
            'strand_id'=>['required', Rule::exists('strands','id')],
        ];
    }

    // edit curriculum
    public function edit(){
        $this->validate();
        
        if(Auth::user()->isAdmin()){
            // check if model exists in database
            if($this->curriculum->exists()){
                $this->curriculum->name = $this->name;
                $this->curriculum->strand_id = $this->strand_id;

                $this->curriculum->save();
            }
        }

        $this->editing = false;
    }

    // delete curriculum
    public function delete(){
        if(Auth::user()->isAdmin()){
            // check if model exists in database
            if($this->curriculum->exists()){
                $this->curriculum->delete();
            }
        }

        $this->deleted = true;
    }

    public function render()
    {
        return view('livewire.admin.curricula-and-subjects.curriculum-card');
    }
}
