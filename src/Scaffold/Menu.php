<?php


namespace Ahmedjoda\Single\Scaffold;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Menu
{

    protected function getItems()
    {
        $menuItems = config('single.menu.items',[]);
        $prefix = str_replace('/','',request()->route()->getPrefix());
        if (isset($menuItems[$prefix])){
            return $menuItems[$prefix];
        }else{
            return [];
        }
    }

    public function render(){
        return view(config('single.menu.view'),['items'=>$this->getItems()]);
    }
    public static function get(){
        $menu = new static();
        return $menu->render();
    }
}
