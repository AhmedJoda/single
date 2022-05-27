<?php


namespace Syscape\Single\Scaffold\Fields;


class Select extends Field
{
    protected $field_options;
    protected $field_view = 'single::fields.select';
    public static function make($title,$name = null) : self
    {
        return new self($title,$name);
    }
    public function options(array $options) : self{
        $this->field_options = $options;
        return $this;
    }
    public function getOptions(){
        return $this->field_options;
    }
    public function indexLabel($item)
    {
        return $this->getLabel($item->getOriginal($this->getName()));
    }
    public function getLabel($key){
        if (isset($this->getOptions()[$key]))
            return $this->getOptions()[$key];
        return $this->getDefaultValue();
    }
}
