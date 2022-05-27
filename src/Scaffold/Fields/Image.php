<?php


namespace Syscape\Single\Scaffold\Fields;


use Illuminate\Support\Facades\Storage;

class Image extends Field
{
    protected $field_view = 'single::fields.image';
    public static function make($title,$name = null) : self
    {
        return new self($title,$name);
    }
    public function indexLabel($item)
    {
        return "<img width=100 src='".Storage::disk(config('single.app.filesystem-disk'))->url($item->getOriginal($this->getName()))."'>";
    }
    public function isFile(): bool
    {
        return true;
    }
}
