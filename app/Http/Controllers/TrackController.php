<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Track;

use App\DataTables\TracksDataTable;

class TrackController extends Controller
{
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

        return ['is_invalid'=>false, 'errors'=>$validator->errors(), 'tracks'=>Track::orderBy('id')->get(['id', 'code'])];
    }

    public static function read($id = 0){
        if($id){
            return Track::find($id);
        }else{
            return Track::all();
        }
    }

    public function update($data){
        return Track::where('id',$data['id'])->update([
            'name'=>$data['name'],
            'code'=>$data['code']
        ]);
    }

    public static function delete(Request $data){
        $track = Track::find($data->id);
        if(!$track || $track->strands->count()){     // check if there is a strand under the track. Tracks with strands cannot be deleted 
            return ['is_invalid'=>1, 'errors'=>['Track doesn\'t exist or track has strands']];
        }

        if(!$track->delete()){                      // if delete fails
            return ['is_invalid'=>1, 'errors'=>['delete failed (database)']];
        }

        return ['is_invalid'=>0,  'tracks'=>Track::orderBy('id')->get(['id', 'code'])];
    }

    public static function dataTable()
    {
        $dataTable = new TracksDataTable;
        return $dataTable->render('dataTables.tracks');
    }

    public function editRow(Request $data){
        if($data->confirm){
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

            if(!$this->update($data->all())){ // if update fails
                return ['is_invalid'=>true, 'errors'=>['error'=>'Updating database failed']];
            } 

            return ['is_invalid'=>false, 'errors'=>$validator->errors(), 'tracks'=>Track::orderBy('id')->get(['id', 'code'])];
            
        }
        
        // if there is no 'confirm' value in request, return a row-edit html

        $track = Track::find($data->id);

        return "<td class=\"text-center text-nowrap sorting_1\">
        <button class=\"btn btn-sm btn-success m-1 tracks-edit-confirm\" row-id=\"$track->id\">Okay</button>
        <button class=\"btn btn-sm btn-warning m-1 tracks-edit-cancel\" row-id=\"$track->id\">Cancel</button>
        <br>
        <span class=\"fs-6\">Confirm edit</span>
        </td>
        <td><input type=\"text\" class=\"form-control\" id=\"edit-track-name\" name=\"name\" value=\"$track->name\" placeholder=\"Must not be empty\"></td>
        <td><input type=\"text\" class=\"form-control\" id=\"edit-track-code\" name=\"code\" value=\"$track->code\"><i class=\"fs-6\">Track code is a unique and short identifier for a track</i></td></td>
        <td>".$track->strands->count()."</td>";
    }
}
