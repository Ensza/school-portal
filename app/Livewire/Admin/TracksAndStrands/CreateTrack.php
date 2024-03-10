<?php

namespace App\Livewire\Admin\TracksAndStrands;

use App\Models\Track;
use Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateTrack extends Component
{
    #[Validate]
    public $name = '';

    #[Validate]
    public $code = '';

    public function rules(){
        return [
            'name'=>'required',
            'code'=>'required|unique:tracks'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'track name is required', 
            'code.required' => 'track code is required', 
            'code.unique' => 'track code must be unique'
        ];
    }

    public function mount(){
        
    }

    public function create(){
        $this->validate();

        if(Auth::user()->isAdmin()){
            Track::create($this->all());
        }
        $this->reset();

        $this->dispatch('track-created');
    }

    public function render()
    {
        return view('livewire.admin.tracks-and-strands.create-track');
    }
}
