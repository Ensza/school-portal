<?php

namespace App\FormMaker;

class Input{
    protected string $id;                   // input id
    protected string $name;                 // column name
    protected bool $is_required = true;    // input is required
    protected string $label;

    function __construct(string $table, string $label, string $name, $is_required = true) {
        $this->id = "$table-form-$name";
        $this->name = $name;
        $this->is_required = $is_required;
        $this->label = $label;
    }

    function getHTML(){
        $HTML = "
        <div class=\"row\">
            <div class=\"col-sm-5 mb-3\">
                <label for=\"$this->id\" class=\"form-label fw-bold\">$this->label</label>
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