<?php

namespace Syscape\Single\View\Components;
use Illuminate\View\Component;

class CounterCard extends Component
{
    public $title;
    public $count;
    public $iconClass;
    public $iconColor;
    public function __construct($title,$count,$iconClass = null,$iconColor = null)
    {
        $this->count = $count;
        $this->title = $title;
        $this->iconClass = $iconClass;
        $this->iconColor = $iconColor;
    }

    public function render()
    {
        return view('single::components.counter-card',[
            'title'=>$this->title,
            'count'=>$this->count,
            'iconColor'=>$this->iconColor,
            'iconClass'=>$this->iconClass,
            ]);
    }
}
