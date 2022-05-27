<?php


namespace Syscape\Single\Scaffold\Fields;


class Text extends Field
{
    protected $field_view = 'single::fields.text';
    public static function make($title,$name = null) : self
    {
        return new self($title,$name);
    }
}
