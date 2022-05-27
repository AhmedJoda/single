<?php


namespace Syscape\Single\Scaffold\Fields;


class Password extends Field
{
    protected $field_view = 'single::fields.password';
    public static function make($title,$name = null) : self
    {
        return new self($title,$name);
    }
}
