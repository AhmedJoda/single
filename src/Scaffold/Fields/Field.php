<?php


namespace Syscape\Single\Scaffold\Fields;


use Illuminate\Support\Str;

class Field
{
    protected $field_title;
    protected $field_name;
    protected $editable = true;
    protected $sortable = true;
    protected $searchable = true;
    protected $show_in_index = true;
    protected $field_view;
    protected $field_default = '';
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
    public function editable($editable = true)
    {
        $this->editable = $editable;
        return $this;
    }
    public function sortable($sortable = true)
    {
        $this->sortable = $sortable;
        return $this;
    }
    public function searchable($searchable = true)
    {
        $this->searchable = $searchable;
        return $this;
    }
    public function isEditable(): bool
    { return $this->editable;}
    public function isSortable(): bool
    { return $this->sortable;}
    public function isSearchable(): bool
    { return $this->searchable;}
    public function showInIndex($show = true)
    {
        $this->show_in_index = $show;
        return $this;
    }
    public function showingInIndex(){
        return $this->show_in_index;
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
