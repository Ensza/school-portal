<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Track;

use App\DataTables\TracksDataTable;
use Illuminate\Support\Facades\DB;

class TrackController extends Controller
{
    public function index(){
        
    }

    public function create(Request $data){
        $validator = validator($data->all(), //validate add track form request
            [
                'name'=>'required',
                'code'=>'required|unique:tracks'
            ],[
                'name'=>'track name is required',
                'code.required'=>'track code is required',
                'code.unique'=>'track code must be unique'
            ]);
        if($validator->fails()){
            return ['is_invalid'=>$validator->fails(), 'errors'=>$validator->errors()];
        }

        if(!Track::create($data->all())){ //if adding to database failed
            return ['is_invalid'=>true, 'errors'=>['error'=>'Adding to database failed']];
        }

        return ['is_invalid'=>false, 'errors'=>$validator->errors()];
    }

    public static function read($id = 0){
        if($id){
            return Track::find($id);
        }else{
            return Track::all();
        }
    }

    public function update(Request $data){
        $validator = validator($data->all(),[
            'id'=>'required|exists:tracks',
            'name'=>'required',
            'code'=>[
                'required',
                Rule::unique('tracks')->ignore($data->id)
                ]
            ]
        );

        if($validator->fails()){
            return ['is_invalid'=>$validator->fails(), 'errors'=>$validator->errors()];
        }

        if(!
            Track::where('id', $data->id)
                ->update($data->except('id', '_token'))
        ){ // if update fails

            return ['is_invalid'=>true, 'errors'=>['error'=>'Updating database failed']];

        } 

        return ['is_invalid'=>false, 'errors'=>$validator->errors()];
    }

    public static function delete($id){
        $track = Track::find($id);
        if(!$track || $track->strands->count()){     // check if there is a strand under the track. Tracks with strands cannot be deleted 
            return ['is_invalid'=>1, 'errors'=>['Track doesn\'t exist or track has strands']];
        }

        if(!$track->delete()){                      // if delete fails
            return ['is_invalid'=>1, 'errors'=>['delete failed (database)']];
        }

        return ['is_invalid'=>0];
    }

    public static function dataTable()
    {
        $dataTable = new TracksDataTable;
        return $dataTable->render('datatable', ['title'=>'Manage tracks']);
    }

    public function editRow($id){

        $model = Track::find($id);

        return "<td class=\"text-center text-nowrap sorting_1\">
        <button class=\"btn btn-sm btn-success m-1 edit-row-confirm ".$model->getTable()."-edit-confirm\" table=\"tracks\" row-id=\"$model->id\">Okay</button>
        <button class=\"btn btn-sm btn-warning m-1 edit-row-cancel ".$model->getTable()."-edit-cancel\" table=\"tracks\" row-id=\"$model->id\">Cancel</button>
        <br>
        <span class=\"fs-6\">Confirm edit</span>
        </td>
        <td><input type=\"text\" class=\"form-control\" name=\"name\" value=\"$model->name\" placeholder=\"Must not be empty\"></td>
        <td><input type=\"text\" class=\"form-control\" name=\"code\" value=\"$model->code\"><i class=\"fs-6\">Track code is a unique and short identifier for a track</i></td></td>
        <td>".$model->strands->count()."</td>".csrf_field();
    }

}
