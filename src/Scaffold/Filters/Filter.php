<?php


namespace Syscape\Single\Scaffold\Filters;


class Filter
{
    protected $filter_title;
    protected $filter_name;
    protected $filter_icon_class = 'fa fa-filter';
    protected $filter_icon_bg_color = 'cyan';
    protected $filter_counter = false;
    protected $filter_query;
    public $filter_view_name = 'single::filters.filter';
    public function __construct($title,$name,$is_counter = false)
    {
        $this->filter_title = $title;
        $this->filter_name = $name;
        $this->filter_counter = $is_counter;
        return $this;
    }
    public static function make($title,$name,$is_counter = false){
        return new static($title,$name,$is_counter);
    }
    public function query($query){
        $this->filter_query = $query;
        return $this;
    }
    public function isCounter(){
        return $this->filter_counter;
    }
    public function count(){
        return $this->filter_query->count();
    }
    public function icon($class,$bg_color){
        $this->filter_icon_bg_color = $bg_color;
        $this->filter_icon_class = $class;
        return $this;
    }
    public function getIconClass(){
        return $this->filter_icon_class;
    }
    public function getIconBgColor(){
        return $this->filter_icon_bg_color;
    }
    public function getQuery(){
        return $this->filter_query;
    }
    public function called(){
        return request()->has('filter_'.$this->filter_name);
    }
    public function getTitle(){
        return $this->filter_title;
    }
    public function getName(){
        return $this->filter_name;
    }
}