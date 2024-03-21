<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Track;
use App\Models\Strand;

class AdminController extends Controller
{
    
    public function dashboardView(){
        return view('admin.dashboard');
    }

    public function tracksAndStrandsView(){
        return view('livewire\admin\tracks-and-strands\tracks-and-strands-volt');
    }

    public function curriculaAndSubjectsView(){
        return view('admin.curricula-and-subjects');
    }

}
