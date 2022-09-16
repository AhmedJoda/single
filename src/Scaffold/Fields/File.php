<?php


namespace Syscape\Single\Scaffold\Fields;


use Illuminate\Support\Facades\Storage;

class File extends Field
{
    protected $field_view = 'single::fields.file';
    protected $multiple = false;

    public static function make($title,$name = null) : self
    {
        return new self($title,$name);
    }
    
    public function isFile(): bool
    {
        return true;
    }

    public function multiple($value) : self
    {
        $this->multiple = $value;
        return $this;
    }

    public function isMultiple() : bool
    {
        return $this->multiple;
    }
}
