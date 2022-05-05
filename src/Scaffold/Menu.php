<?php


namespace Ahmedjoda\Single\Scaffold;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Menu
{
    public $items = [];
    function checkInside($directory, $parent = null)
    {
        foreach ($this->getInside($directory) as $fileName) {
            $file  = strpos($fileName, '.php');
            if ($file) {
                $this->addItems($fileName, $parent);
            } else {
                $this->checkInside("$directory/$fileName", $fileName);
            }
        }
    }

    function getInside($directory)
    {

        return  array_diff(scandir($directory), array('.', '..'));
    }

    function addItems($fileName, $parent = null)
    {
        $single = $this->remove_php_extension($fileName);
        $route = Str::plural(Str::lower($single));
        $parent = Str::lower( $parent );
        if ($parent  == config('single.app.route-prefix')) {
            array_push($this->items,[
                'route'=>"$parent.$route.index",
                'title'=>__("$parent.".Str::ucfirst($route))
            ]);
        }
    }

    function remove_php_extension($fileName)
    {
        return str_replace(".php", "", $fileName);
    }
    public function render(){
        if (config('single.menu.items')){
            // TODO: custom items
        }else{
            $this->checkInside(base_path('app/Singles'));
            return view(config('single.menu.view'),['items'=>$this->items]);
        }
    }
    public static function get(){
        $menu = new static();
        return $menu->render();
    }
}
