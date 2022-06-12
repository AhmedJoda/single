<?php


namespace Syscape\Single\Traits;


trait ScaffoldTrait
{
    public $creating = true;
    public $editing = true;
    public $deleting = true;
    public function getIndexRoute(){
        return $this->route.'.index';
    }
    public function getIndexTitle(){
        return __($this->route);
    }



    public function setCreateView(){
        return 'single::master.create';
    }
    public function disableCreate(){
        $this->creating = false;
    }
    public function disableEdit(){
        $this->editing = false;
    }
    public function disableDelete(){
        $this->deleting = false;
    }
    ### abstracted
    public function fields(): array { return []; }
    public function bottle(){}
}