<?php


namespace Syscape\Single\Scaffold\Fields;


class Checkbox extends Field
{
    protected $field_view = 'single::fields.checkbox';
    protected $field_value_1 = 1;
    protected $field_value_0 = 0;
    protected $field_title_1 = 'enabled';
    protected $field_title_0 = 'disabled';
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
    public function getTableValue($item)
    {
        switch ($item->getOriginal($this->getName())){
            case $this->field_value_1:
                return $this->field_title_1;
            case $this->field_value_0:
                return $this->field_title_0;
        }
        return $this->getDefaultValue();
    }

    public function getCheckedValue(){
        return $this->field_value_1;
    }
    public function getUncheckValue(){
        return $this->field_value_0;
    }
}
