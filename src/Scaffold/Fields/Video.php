<?php


namespace Syscape\Single\Scaffold\Fields;


use Illuminate\Support\Facades\Storage;

class Video extends Field
{
    protected $field_view = 'single::fields.video';
    public static function make($title,$name = null) : self
    {
        $instance =  new self($title,$name);
        $instance->showInIndex(false);
        return $instance;
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
