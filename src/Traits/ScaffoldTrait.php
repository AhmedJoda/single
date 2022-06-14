<?php


namespace Syscape\Single\Traits;


trait ScaffoldTrait
{
    public $creating = true;
    public $editing = true;
    public $deleting = true;
    public $hide_from_menu = false;
    public function getIndexRoute(){
        return $this->route.'.index';
    }
    public function getIndexTitle(){
        return __($this->route);
    }
    public function hideFromMenu(bool $when = true){
        if ($when){
            $this->hide_from_menu = true;
        }
    }
    public function setCreateView(){
        return 'single::master.create';
    }
    public function disableCreate(bool $when = true){
        if ($when){
            $this->creating = false;
        }
    }
    public function disableEdit(bool $when = true){
        if ($when){
            $this->editing = false;
        }
    }
    public function disableDelete(bool $when = true){
        if ($when){
            $this->deleting = false;
        }
    }
    ### abstracted
    public function fields(): array { return []; }
    public function filters(): array { return []; }
    public function bottle(){}

}