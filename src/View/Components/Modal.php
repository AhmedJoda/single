<?php

namespace Ahmedjoda\Single\View\Components;
use Illuminate\View\Component;

class Modal extends Component
{
    public $key;
    public $title;
    public function __construct($key,$title='')
    {
        $this->key = $key;
        $this->title = $title;
    }

    public function render()
    {
        return view('single::components.modal',['key'=>$this->key,'title'=>$this->title]);
    }
}
