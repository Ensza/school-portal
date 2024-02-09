<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Strand;
use App\DataTables\StrandsDataTable;

class StrandController extends Controller
{
    public static function create($input){
        return Strand::create($input);
    }

    public static function dataTable()
    {
        $dataTable = new StrandsDataTable;
        return $dataTable->render('dataTables.strands');
    }
}
