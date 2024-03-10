<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Strand;
use App\DataTables\StrandsDataTable;

class StrandController extends Controller
{
    public function create(Request $data){
        $validator = validator($data->all(), //validate add strand form request
            [
                'name'=>'required',
                'code'=>'required|unique:strands',
                'track_id'=>'required|exists:tracks,id'
            ],[
                'name'=>'strand name is required',
                'code.required'=>'strand code is required',
                'code.unique'=>'strand code must be unique',
                'track_id.required'=>'please select a track',
                'track_id.exists'=>'track doesn\'t exist'
            ]);
        if($validator->fails()){
            return ['is_invalid'=>$validator->fails(), 'errors'=>$validator->errors()];
        }
        if(!Strand::create($data->all())){ //if adding to database failed
            return ['is_invalid'=>true, 'errors'=>['error'=>'Adding to database failed']];
        }

        return ['is_invalid'=>false, 'errors'=>$validator->errors()];
    }

    public function update(Request $data){
        $validator = validator($data->all(),[
            'id'=>'required|exists:strands',
            'name'=>'required',
            'code'=>[
                'required',
                Rule::unique('strands')->ignore($data->id)
            ],
            'track_id'=>'required|exists:tracks,id',
            ]
        );

        if($validator->fails()){
            return ['is_invalid'=>$validator->fails(), 'errors'=>$validator->errors()];
        }

        if(!
            Strand::where('id', $data->id)
                ->update($data->except('id', '_token'))
        ){ // if update fails
            return ['is_invalid'=>true, 'errors'=>['error'=>'Updating database failed']];
        } 

        return ['is_invalid'=>false, 'errors'=>$validator->errors()];

    }

    public function delete($id){
        $strand = Strand::find($id);
        if(!$strand){     // check if there is a strand under the track. Tracks with strands cannot be deleted 
            return ['is_invalid'=>1, 'errors'=>['strand doesn\'t exist']];
        }

        if(!$strand->delete()){                      // if delete fails
            return ['is_invalid'=>1, 'errors'=>['delete failed (database)']];
        }

        return ['is_invalid'=>0];
    }

    public static function dataTable()
    {
        $dataTable = new StrandsDataTable;
        return $dataTable->render('datatable', ['title'=>'Manage strands']);
    }

    public function editRow($id){
        // if there is no 'confirm' value in request, return a row-edit html

        $model = Strand::find($id);
        $tracks = \App\Models\Track::all();
        $track_select = '';

        foreach($tracks as $track){                     // create select tracks form
            $track_select.="<option value=\"$track->id\"".($model->track_id == $track->id ? 'selected' : '').">$track->code</option>";
        }

        return "<td class=\"text-center text-nowrap sorting_1\">
        <button class=\"btn btn-sm btn-success m-1 edit-row-confirm ".$model->getTable()."-edit-confirm\" table=\"".$model->getTable()."\" row-id=\"$model->id\">Okay</button>
        <button class=\"btn btn-sm btn-warning m-1 edit-row-cancel ".$model->getTable()."-edit-cancel\" table=\"".$model->getTable()."\" row-id=\"$model->id\">Cancel</button>
        <br>
        <span class=\"fs-6\">Confirm edit</span>
        </td>
        <td><input type=\"text\" class=\"form-control\" name=\"name\" value=\"$model->name\" placeholder=\"Must not be empty\"></td>
        <td><input type=\"text\" class=\"form-control\" name=\"code\" value=\"$model->code\"><i class=\"fs-6\">Strand code is a unique and short identifier for a strand</i></td>
        <td>
        <select class=\"form-select strand-form\" name=\"track_id\">
            $track_select
        </select>
        </td>".csrf_field();
    }
}
