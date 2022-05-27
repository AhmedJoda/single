<?php


namespace Syscape\Single\Scaffold\Fields;


class Number extends Field
{
    protected $field_view = 'single::fields.number';
    public static function make($title,$name = null) : self
    {
        return new self($title,$name);
    }
}
