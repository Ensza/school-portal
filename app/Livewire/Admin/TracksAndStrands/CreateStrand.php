<?php

namespace App\Livewire\Admin\TracksAndStrands;

use App\Models\Strand;
use Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateStrand extends Component
{
    #[Validate]
    public $track_id;

    #[Validate]
    public $name;
    #[Validate]
    public $code;

    public $creating = false;

    public function rules(){
        return [
            'track_id'=>'required|exists:tracks,id',
            'name'=>'required',
            'code'=>'required|unique:strands'  
        ];
    }

    public function create(){
        $this->validate();

        if(Auth::user()->isAdmin()){
            Strand::create($this->all());

            $this->creating = false;
        }

        $this->name = '';
        $this->code = '';
        $this->dispatch('strand-created');
    }

    public function render()
    {
        return view('livewire.admin.tracks-and-strands.create-strand');
    }
}
