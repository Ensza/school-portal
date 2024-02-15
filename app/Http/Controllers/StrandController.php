<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Strand;
use App\DataTables\StrandsDataTable;

class StrandController extends Controller
{
    public static function create(Request $data){
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

    public static function update($data){
        return Strand::where('id',$data['id'])->update([
            'name'=>$data['name'],
            'code'=>$data['code'],
            'track_id'=>$data['track_id']
        ]);
    }

    public static function delete(Request $data){
        $strand = Strand::find($data->id);
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
        return $dataTable->render('dataTables.strands');
    }

    public function editRow(Request $data){
        if($data->confirm){
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

            if(!$this->update($data->all())){ // if update fails
                return ['is_invalid'=>true, 'errors'=>['error'=>'Updating database failed']];
            } 

            return ['is_invalid'=>false, 'errors'=>$validator->errors()];
            
        }

        // if there is no 'confirm' value in request, return a row-edit html

        $strand = Strand::find($data->id);
        $tracks = \App\Models\Track::all();
        $track_select = '';
        foreach($tracks as $track){                     // create select tracks form
            $track_select.="<option value=\"$track->id\"".($strand->track_id == $track->id ? 'selected' : '').">$track->code</option>";
        }
        return "<td class=\"text-center text-nowrap sorting_1\">
        <button class=\"btn btn-sm btn-success m-1 strands-edit-confirm\" row-id=\"$strand->id\">Okay</button>
        <button class=\"btn btn-sm btn-warning m-1 strands-edit-cancel\" row-id=\"$strand->id\">Cancel</button>
        <br>
        <span class=\"fs-6\">Confirm edit</span>
        </td>
        <td><input type=\"text\" class=\"form-control\" id=\"edit-strand-name\" name=\"name\" value=\"$strand->name\" placeholder=\"Must not be empty\"></td>
        <td><input type=\"text\" class=\"form-control\" id=\"edit-strand-code\" name=\"code\" value=\"$strand->code\"><i class=\"fs-6\">Strand code is a unique and short identifier for a strand</i></td>
        <td>
        <select class=\"form-select strand-form\" id=\"edit-strand-track_id\" name=\"track_id\">
            $track_select
        </select>
        </td>";
    }

    public static function edit_row_html($id){
        
    }
}
