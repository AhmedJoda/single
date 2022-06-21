<?php


namespace Syscape\Single\Scaffold\Tables;

use Syscape\Single\Scaffold\Fields\Field;

class Table
{
    protected $fields ;
    protected $model ;
    protected $route ;
    protected $table_view = 'single::tables.table';
    protected $pagination_length = 10 ;
    protected $table_data = null;
    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    public static function make($fields)
    {
        $fields = array_filter($fields, function (Field $field) {
            return $field->showingInIndex();
        });
        return new self($fields);
    }
    public function render()
    {
        return view($this->table_view, ['table'=>$this]);
    }
    public function model($model)
    {
        $this->model = $model;
        return $this;
    }
    public function route($route)
    {
        $this->route = $route;
        return $this;
    }
    public function getQuery()
    {
        return $this->model::query();
    }
    public function data($data)
    {
        $this->table_data = $data;
        return $this;
    }
    public function getData()
    {
        return $this->table_data ?? $this->getModel()::all();
    }
    public function getFields()
    {
        return $this->fields;
    }
    public function getRoute()
    {
        return $this->route;
    }
    public function getModel()
    {
        return $this->model;
    }
    public function paginate($count)
    {
        $this->pagination_length = $count;
        return $this;
    }
    public function getPaginationLength()
    {
        return $this->pagination_length;
    }
}
