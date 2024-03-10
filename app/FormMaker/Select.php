<?php

namespace App\FormMaker;

use Illuminate\Support\Facades\DB;

class Select{
    protected string $id;                   
    protected string $label;
    protected string $name;                 
    protected bool $is_required = true;    

    protected string $select_table;
    protected string $options_column;
    protected string $values_column;
    protected $options;

    function __construct(

        string $table,                  // the table this input is registered
        $id,                            // input id
        string $label,
        string $name,                   // column name
        $is_required = true,            // if the input is required
        string $select_table,           // the table where the options will come from
        string $options_column,         // The column of which the options comes from
        string $values_column = 'id',   // the column of which the value of the options will come from

        ) {

        $this->id = "$table-form-$id";
        $this->name = $name;
        $this->label = $label;
        $this->is_required = $is_required;
        $this->select_table = $select_table;
        $this->options_column = $options_column;
        $this->values_column = $values_column;

        $this->options = DB::table($select_table)->select($values_column, $options_column)->oldest()->get();

    }

    function getHTML(){
        $options = '';

        foreach($this->options as $option){
            $options .= "<option value=\"".((array) $option)[$this->values_column]."\">".((array) $option)[$this->options_column]."</option>";
        }

        $HTML = "
        <div class=\"row\">
            <div class=\"col-sm-5 mb-3\">
                <label for=\"$this->id\" class=\"form-label fw-bold\">$this->label</label>
                <select 
                class=\"form-select\" 
                id=\"$this->id\" 
                name=\"$this->name\"
                ".($this->is_required ? 'required':'')."
                >
                    $options
                </select>
            </div>
        </div>
        ";

        return $HTML;
    }
}