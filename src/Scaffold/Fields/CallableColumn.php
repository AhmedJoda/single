<?php


namespace Syscape\Single\Scaffold\Fields;


class CallableColumn extends Field
{
    protected $field_view = 'single::fields.text';
    public static function make($title,$name = null) : self
    {
        $instance = new self($title,$name);
        $instance->createable(false)
            ->editable(false);
        return $instance;
    }
}
