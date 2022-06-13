<?php


namespace Syscape\Single\Scaffold\Fields;


class CkeText extends Field
{
    protected $field_view = 'single::fields.cke-text';
    public static function make($title,$name = null) : self
    {
        return new self($title,$name);
    }
}
