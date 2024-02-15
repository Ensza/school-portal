<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class FormController extends Controller
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
        array $required_columns = [], 
        array $exclude_columns = []

        ){

        $table_columns = Schema::getColumnListing($table);
        $excluded_columns = array_merge($this->excluded_columns, $exclude_columns);

        $columns = collect($table_columns)->diff($excluded_columns);

        $inputs = [];

        foreach($columns->all() as $column){
            
            $input = new Input(
                $table, 
                $column, 
                $column, 
                array_key_exists($column, $required_columns) ? $required_columns[$column] : true
            );

            array_push($inputs,$input);
        }

        return view($form_view, [
            'inputs'=>$inputs, 
            'table'=>$table,
            'action_url'=>$action_url, 
            'method'=>$method
        ]);
    }
}

class Input{
    protected string $id;                   // input id
    protected string $name;                 // column name
    protected bool $is_required = true;    // input is required

    function __construct(string $table, $id, string $name, $is_required = true) {
        $this->id = "$table-form-$id";
        $this->name = $name;
        $this->is_required = $is_required;
    }

    function getHTML(){
        $HTML = "
        <div class=\"row\">
            <div class=\"col-sm-5 mb-3\">
                <label for=\"$this->id\" class=\"form-label fw-bold\">$this->name</label>
                <input 
                type=\"text\" 
                class=\"form-control track-form\" 
                id=\"$this->id\" name=\"$this->name\" 
                placeholder=\"\" 
                ".($this->is_required ? 'required':'')."
            >
            </div>
        </div>
        ";

        return $HTML;
    }
}
