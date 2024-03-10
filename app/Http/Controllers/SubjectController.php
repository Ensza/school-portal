<?php

namespace App\Http\Controllers;

use App\DataTables\SubjectsDataTable;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function create(Request $data){
        $validator = validator($data->all(), //validate add strand form request
            [
                'name'=>'required',
            ],[
                'name'=>'subject name is required',
            ]);
        if($validator->fails()){
            return ['is_invalid'=>$validator->fails(), 'errors'=>$validator->errors()];
        }
        if(!Subject::create($data->all())){ //if adding to database failed
            return ['is_invalid'=>true, 'errors'=>['error'=>'Adding to database failed']];
        }

        return ['is_invalid'=>false, 'errors'=>$validator->errors()];
    }

    public function update(Request $data, $id){
        return Subject::where('id',$id)->update([
            'name'=>$data['name'],
        ]);
    }

    public function delete($id){
        $strand = Subject::find($id);
        if(!$strand){     // check if there is a strand under the track. Tracks with strands cannot be deleted 
            return ['is_invalid'=>1, 'errors'=>['subject doesn\'t exist']];
        }

        if(!$strand->delete()){                      // if delete fails
            return ['is_invalid'=>1, 'errors'=>['delete failed (database)']];
        }

        return ['is_invalid'=>0];
    }

    public static function dataTable()
    {
        $dataTable = new SubjectsDataTable;
        return $dataTable->render('dataTable', ['title'=>'Manage subjects']);
    }

    public function editRow(Request $data, $id){
        if($data->confirm){
            $validator = validator($data->all(),[
                    'id'=>'required|exists:subjects',
                    'name'=>'required',
                ]
            );

            if($validator->fails()){
                return ['is_invalid'=>$validator->fails(), 'errors'=>$validator->errors()];
            }

            if(!$this->update($data, $id)){ // if update fails
                return ['is_invalid'=>true, 'errors'=>['error'=>'Updating database failed']];
            } 

            return ['is_invalid'=>false, 'errors'=>$validator->errors()];
            
        }

        // if there is no 'confirm' value in request, return a row-edit html

        $model = Subject::find($id);

        return "<td class=\"text-center text-nowrap sorting_1\">
        <button class=\"btn btn-sm btn-success m-1 edit-row-confirm ".$model->getTable()."-edit-confirm\" table=\"".$model->getTable()."\" row-id=\"$model->id\">Okay</button>
        <button class=\"btn btn-sm btn-warning m-1 edit-row-cancel ".$model->getTable()."-edit-cancel\" table=\"".$model->getTable()."\" row-id=\"$model->id\">Cancel</button>
        <br>
        <span class=\"fs-6\">Confirm edit</span>
        </td>
        <td>$model->id</td>
        <td><input type=\"text\" class=\"form-control\" id=\"edit-subject-name\" name=\"name\" value=\"$model->name\" placeholder=\"Must not be empty\"></td>
        ";
    }
}
