<?php

namespace App\Livewire\Admin\CurriculaAndSubjects;

use App\Models\Curriculum;
use App\Models\Strand;
use Livewire\Attributes\On;
use Livewire\Component;

class Curricula extends Component
{
    public $strands;
    public $curricula;

    public $selected_strand_id = 0;
    
    #[On('curriculum-created')]
    public function mount(){
        $this->curricula = Curriculum::all();
        $this->strands = Strand::all();
        $this->selected_strand_id = 0;
    }

    public function updated(){
        if($this->selected_strand_id == 0){
            $this->curricula = Curriculum::all();
        }else{
            $this->curricula = Curriculum::where('strand_id', $this->selected_strand_id)->get();
        }
    }

    public function render()
    {
        return view('livewire.admin.curricula-and-subjects.curricula');
    }
}
