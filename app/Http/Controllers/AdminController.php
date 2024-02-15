<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Track;
use App\Models\Strand;

class AdminController extends Controller
{
    public function tracks_and_strands_view(){
        return view('admin.tracks-and-strands',[
            'tracks'=>Track::all(), 
            'strands'=>Strand::all(),
            'tracks_table'=>TrackController::dataTable(),
            'strands_table'=>StrandController::dataTable()
        ]);
    }
}
