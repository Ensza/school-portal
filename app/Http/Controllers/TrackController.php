<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;

use App\DataTables\TracksDataTable;

class TrackController extends Controller
{
    public static function create($input){
        return Track::create($input);
    }

    public static function dataTable()
    {
        $dataTable = new TracksDataTable;
        return $dataTable->render('dataTables.tracks');
    }
}
