<?php


namespace Syscape\Single\Scaffold;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class TopBar
{

    protected function getItems()
    {
        $menuItems = config('single.top-bar.user-links-items',[]);
        $prefix = str_replace('/','',request()->route()->getPrefix());
        if (isset($menuItems[$prefix])){
            return $menuItems[$prefix];
        }else{
            return [];
        }
    }

    public function renderUserLinks(){
        return view(config('single.top-bar.user-links-view'),['items'=>$this->getItems()]);
    }
    public static function getUserLinks(){
        $menu = new static();
        return $menu->renderUserLinks();
    }
}
