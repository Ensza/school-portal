<?php

namespace App\Livewire\Admin\CurriculaAndSubjects;

use App\Models\Curriculum;
use App\Models\Strand;
use Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateCurriculum extends Component
{
    public $strands;

    #[Validate]
    public $strand_id;

    #[Validate]
    public $name;

    public $created = false;

    public function rules(){
        return [
            'strand_id'=>'required|exists:strands,id',
            'name'=>'required'
        ];
    }

    public function messages(){
        return [
            'strand_id.required'=>'Strand is required',
            'strand_id.exists'=>'Strand doesn\'t exist',
            'name'=>'Curriculum name is required'
        ];
    }

    public function mount(){
        $this->strands = Strand::all();
    }

    public function create(){
        $this->created = false;
        $this->validate();

        if(Auth::user()->isAdmin()){
            Curriculum::create($this->all());
        }
        
        $this->created = true;
        $this->dispatch('curriculum-created');
    }

    public function render()
    {
        return view('livewire.admin.curricula-and-subjects.create-curriculum');
    }
}
