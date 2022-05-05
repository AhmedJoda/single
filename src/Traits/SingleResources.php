<?php

namespace Ahmedjoda\Single\Traits;

use Illuminate\Support\Str;

trait SingleResources
{
    public function singleIndex()
    {
        if (method_exists($this, 'query')) {
            ${$this->pluralName} = $this->query($this->model::query())->get();
        } else {
            ${$this->pluralName} = $this->model::all();
        }
        $p_name = Str::ucfirst($this->pluralName);
        $index = ${$this->pluralName};
        $route = $this->route;
        $columns = $this->tableColumns();
        return view("{$this->view}.index", compact($this->pluralName, 'index', 'route','p_name','columns'));
    }
}
