<?php


namespace Syscape\Single\Scaffold\Tables;


class Table
{
    protected $fields ;
    public function __construct($fields)
    {
    }

    public static function make($fields){
        return new self($fields);
    }
}
