<?php


namespace Syscape\Single\Scaffold\Fields;


class TextArea extends Field
{
    protected $field_view = 'single::fields.textarea';
    public static function make($title,$name = null) : self
    {
        return new self($title,$name);
    }
}
