<?php

namespace App\FormMaker;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\FormMaker\Input;

class FormMaker
{
    protected $excluded_columns = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function make(

        string $table, 
        string $action_url,
        string $method,
        string $form_view, 
        array $input_labels = [],
        array $required_columns = [], 
        array $exclude_columns = [],
        array $extra = [],

        ){

        $table_columns = Schema::getColumnListing($table);
        $excluded_columns = array_merge($this->excluded_columns, $exclude_columns);

        $inputs = [];

        foreach($table_columns as $column){
            if(!in_array($column, $excluded_columns)){
                $input = new Input(
                    $table, 
                    array_key_exists($column, $input_labels) ? $input_labels[$column] : $column, 
                    $column, 
                    array_key_exists($column, $required_columns) ? true : false
                );
    
                array_push($inputs,$input);
            }
        }
        
        $inputs = array_merge($inputs, $extra);

        return view($form_view, [
            'inputs'=>$inputs, 
            'table'=>$table,
            'action_url'=>$action_url, 
            'method'=>$method
        ]);
    }
}
