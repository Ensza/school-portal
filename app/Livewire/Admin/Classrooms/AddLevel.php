<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Level;
use Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddLevel extends Component
{
    #[Validate('required')]
    public $name = '';

    public $created = false;

    public function create(){
        $this->validate();

        if(Auth::user()->isAdmin()){
            Level::create(['name'=>$this->name]);
        }

        $this->reset();
        $this->created = true;
        $this->dispatch('level-created');
    }
    public function render()
    {
        return view('livewire.admin.classrooms.add-level');
    }
}
