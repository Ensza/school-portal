<?php

namespace App\Livewire\Admin\TracksAndStrands;

use App\Models\Track;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TrackCard extends Component
{
    public Track $track;

    #[Validate]
    public $name = '';

    #[Validate]
    public $code = '';

    public $deleted = false;
    public $disabled = false;
    public $editing = false;
    public $creating = false;

    public function rules(){
        return [
            'name'=>'required',
            'code'=>[
                'required',
                Rule::unique('tracks')->ignore($this->track->id)
            ]
        ];
    }

    public function mount($track){
        $this->track = $track;
        $this->name = $track->name;
        $this->code = $track->code;

        $this->disabled = $track->strands->count() > 0 ? true : false;
    }

    public function edit(){
        //validate first, return errors if validation fails
        $this->validate();

        // always check for authorization
        if(Auth::user()->isAdmin()){
            $this->track->name = $this->name;
            $this->track->code = $this->code;

            $this->track->save();
        }
        
        $this->editing = false;
    }

    public function enableEdit(){
        $this->name = $this->track->name;
        $this->code = $this->track->code;

        $this->editing = true;
    }

    public function delete(){
        if($this->track->strands->count()){
            return; // return if track has strand/s under
        }

        // always check for authorization
        if(Auth::user()->isAdmin()){
            // check first if the instance of the model exists in the database
            if($this->track->exists()){
                $this->track->delete();
            }
        }
        
        $this->deleted = true;
        //$this->dispatch('track-deleted');
    }
    
    public function render()
    {
        return view('livewire.admin.tracks-and-strands.track-card');
    }
}
