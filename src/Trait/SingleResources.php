<?php

namespace Ahmedjoda\Single\Trait;

trait SingleResources
{
    public function singleIndex()
    {
        if (method_exists($this, 'query')) {
            ${$this->pluralName} = $this->query($this->model::query())->get();
        } else {
            ${$this->pluralName} = $this->model::all();
        }
        
        $index = ${$this->pluralName};
        $route = $this->route;
        return view("{$this->view}.index", compact($this->pluralName, 'index', 'route'));
    }
}
