<?php


namespace Syscape\Single\Traits;


trait DataTable
{
    protected function textColumn($title,$data){
        return compact('title','data');
    }
    protected function customColumn($title,$callable){
        return compact('title','callable');
    }
}
