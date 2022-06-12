<?php


namespace Syscape\Single\Scaffold\Fields;


class Checkbox extends Field
{
    protected $field_view = 'single::fields.checkbox';
    protected $field_value_1 = 1;
    protected $field_value_0 = 0;
    public static function make($title,$name = null) : self
    {
        return new self($title,$name);
    }
    public function values($checked,$uncheck){
        $this->field_value_1 = $checked;
        $this->field_value_0 = $uncheck;
    }
    public function getCheckedValue(){
        return $this->field_value_1;
    }
    public function getUncheckValue(){
        return $this->field_value_0;
    }
}
