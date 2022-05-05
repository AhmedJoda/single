<?php


namespace Ahmedjoda\Single\Traits;


trait DataTable
{
    protected function textColumn($title,$data){
        return compact('title','data');
    }
}
