<?php

namespace App\Livewire\Admin\TracksAndStrands;

use App\Models\Curriculum;
use App\Models\Strand;
use Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StrandRow extends Component
{
    public Strand $strand;

    #[Validate]
    public $name;
    #[Validate]
    public $code;

    public $editing = false;
    public $deleted = false;

    public function rules(){
        return [
            'name'=>'required',
            'code'=>['required', Rule::unique('strands')->ignore($this->strand->id)]
        ];
    }

    public function mount(){
        $this->name = $this->strand->name;
        $this->code = $this->strand->code;
    }

    public function updateRow(){
        //validate first, return errors if validation fails
        $this->validate();

        // always check for authorization
        if(Auth::user()->isAdmin()){
            $this->strand->name = $this->name;
            $this->strand->code = $this->code;

            $this->strand->save();
        }

        $this->editing = false;
    }

    public function deleteRow(){
        if(Auth::user()->isAdmin()){
            Curriculum::where('strand_id', $this->strand->id)->delete();
            // check first if the instance of the model exists in the database
            if($this->strand->exists()){
                $this->strand->delete();
            }
        }
        
        $this->deleted = true;
    }

    public function render()
    {
        return view('livewire.admin.tracks-and-strands.strand-row');
    }
}
