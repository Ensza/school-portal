<?php

namespace App\Livewire\Admin\CurriculaAndSubjects;

use App\Models\Subject as ModelsSubject;
use Livewire\Component;

class Subject extends Component
{
    public ModelsSubject $subject;

    public function render()
    {
        return view('livewire.admin.curricula-and-subjects.subject');
    }
}
