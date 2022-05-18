<?php


namespace Ahmedjoda\Single\Traits;


trait FormFields
{
    protected function field($title,$name,$editable,$view): array
    {
        return compact('title','name','editable','view');
    }
    protected function textField($title,$name,$editable = true, $view = 'single::fields.text'): array
    {
        return $this->field($title,$name,$editable,$view);
    }
    protected function numberField($title,$name,$editable = true, $view = 'single::fields.number'): array
    {
        return $this->field($title,$name,$editable,$view);
    }
    protected function passwordField($title,$name,$editable = true, $view = 'single::fields.password'): array
    {
        return $this->field($title,$name,$editable,$view);
    }
    protected function imageField($title,$name,$editable = true, $view = 'single::fields.image'): array
    {
        array_push($this->files,$name);
        return $this->field($title,$name,$editable,$view);
    }
    protected function selectField($title,$name,$options,$editable = true,$view= 'single::fields.select'): array
    {
        return compact('title','name','options','editable','view');
    }
}
