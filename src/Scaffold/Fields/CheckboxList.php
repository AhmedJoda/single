<?php


namespace Syscape\Single\Scaffold\Fields;


class CheckboxList extends Field
{
    protected $field_view = 'single::fields.checkbox-list';
    protected $field_value_1 = 1;
    protected $field_value_0 = 0;
    protected $field_title_1 = 'enabled';
    protected $field_title_0 = 'disabled';
    protected $field_list = [];
    public static function make($title,$name = null) : self
    {
        return new self($title,$name);
    }
    public function values($checked,$uncheck){
        $this->field_value_1 = $checked;
        $this->field_value_0 = $uncheck;
        return $this;
    }
    public function titles($checked,$uncheck){
        $this->field_title_1 = $checked;
        $this->field_title_0 = $uncheck;
        return $this;
    }
    public function addItem($key,$value){
        $this->field_list[$key] = $value;
        return $this;
    }
    public function items(array $items){
        $this->field_list = $items;
        return $this;
    }
    public function getItems(){
        return $this->field_list;
    }

    public function getCheckedValue(){
        return $this->field_value_1;
    }
    public function getUncheckValue(){
        return $this->field_value_0;
    }
}
