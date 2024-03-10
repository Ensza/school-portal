<?php

namespace App\Http\Controllers;

use App\DataTables\CurriculaDataTable;
use Illuminate\Http\Request;

class CurriculumControler extends Controller
{

    public static function dataTable()
    {
        $dataTable = new CurriculaDataTable;
        return $dataTable->render('datatable', ['title'=>'Manage strands']);
    }
}
