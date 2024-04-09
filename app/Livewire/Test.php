<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Test extends Component
{
    use WithFileUploads;

    public $file;

    public function debug(){
        dd(asset('profile-pictures/N43YYbMvraHYnuB5mZEUpof86CcytBOEpOX3TocX.png'));
        //dd($this->all());
    }

    public function save(){
        $this->file->store('profile-pictures');
    }

    public function render()
    {
        return view('livewire.test');
    }
}
