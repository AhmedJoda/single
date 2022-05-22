<?php


namespace Ahmedjoda\Single\Scaffold\Fields;


use Illuminate\Support\Str;

class Field
{
    protected $field_title;
    protected $field_name;
    protected $editable;
    protected $sortable;
    protected $show_in_index;
    protected $field_view;
    protected $field_default;
    public function indexLabel($item){
        return $item->getOriginal($this->getName()) ?? $this->getDefaultValue();
    }
    public function __construct($title,$name)
    {
        $this->field_title = $title;
        $name = ($name ?? Str::snake($title));
        $this->field_name = $name;
        return $this;
    }

    public static function make($title,$name = null)
    {
        $name = ($name ?? Str::snake($title));
        return new self($title,$name);
    }
    public function editable($editable = true): self
    {
        $this->editable = $editable;
        return $this;
    }
    public function sortable($sortable = true): self
    {
        $this->sortable = $sortable;
        return $this;
    }
    public function showInIndex($show = true): self
    {
        $this->show_in_index = $show;
        return $this;
    }
    public function setViewName($name){
        $this->field_view = $name;
    }
    public function default($value){
        if (is_callable($value)){
            // TODO
        }else{
            $this->field_default = $value;
        }
        return $this;
    }
    public function getViewName(){
        return $this->field_view;
    }
    public function getName(){
        return $this->field_name;
    }
    public function getTitle(){
        return $this->field_title;
    }
    public function getDefaultValue(){
        return $this->field_default;
    }
    public function isFile() : bool{
        return false;
    }
}
