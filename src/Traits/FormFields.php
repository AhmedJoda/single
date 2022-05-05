<?php


namespace Ahmedjoda\Single\Traits;


trait FormFields
{
    protected function textField($title,$name){
        return [
            'title' => $title,
            'name' => $name,
            'view' => 'single::fields.text',
        ];
    }
    protected function numberField($title,$name){
        return [
            'title' => $title,
            'name' => $name,
            'view' => 'single::fields.number',
        ];
    }
    protected function passwordField($title,$name){
        return [
            'title' => $title,
            'name' => $name,
            'view' => 'single::fields.password',
        ];
    }
    protected function imageField($title,$name){
        return [
            'title' => $title,
            'name' => $name,
            'view' => 'single::fields.image',
        ];
    }
    protected function selectField($title,$name,$options){
        return [
            'title' => $title,
            'name' => $name,
            'options' => $options,
            'view' => 'single::fields.select',
        ];
    }
}
