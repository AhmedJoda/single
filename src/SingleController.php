<?php

namespace Syscape\Single;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Syscape\Single\Scaffold\Tables\Table;
use Syscape\Single\Traits\ScaffoldTrait;
use Syscape\Single\Traits\SingleResources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use ReflectionClass;
use Illuminate\Http\Request;

class SingleController extends Model
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, SingleResources,ScaffoldTrait;
    protected $item;
    protected $model;
    protected $pluralName;
    protected $name;
    protected $route;
    protected $view;

    public function __construct($attributes = [])
    {

        parent::__construct($attributes);
        $this->setModelName();
        $this->initAttributeNames();
    }

    public function singleIndex()
    {
        $this->bottle();// Scaffold init ;)
        if (method_exists($this, 'query')) {
            ${$this->pluralName} = $this->query($this->model::query())->get();
        } else {
            ${$this->pluralName} = $this->model::all();
        }
        $p_name = Str::ucfirst($this->pluralName);
        $index = ${$this->pluralName};
        $route = $this->route;
        $title = $this->getIndexTitle();
        $table = Table::make($this->fields())->model($this->model)->route($route);
        $instance = $this;
        return view("{$this->view}.index", compact($this->pluralName, 'index', 'instance', 'title', 'route', 'p_name', 'table'));
    }

    public function SingleCreate()
    {
        $this->bottle();// Scaffold init ;)
        $p_name = Str::ucfirst($this->pluralName);
        $route = $this->route;
        $title = trans('admin.create');
        $fields = $this->fields();
        $instance = $this;
        return view($this->setCreateView(), compact('route', 'title','instance', 'p_name', 'fields'));
    }


    public function singleStore()
    {
        $this->bottle();// Scaffold init ;)
        $this->validateStoreRequest();
        $this->beforeStore();

        $data = $this->hashingFeilds($this->uploadFilesIfExist());

        $this->model::create($data);
        
        $this->afterStore();

        session()->flash('success', trans('admin.added'));

        return redirect(route("$this->route.index"));
    }


    public function singleShow($id)
    {
        $this->bottle();// Scaffold init ;)
        ${$this->name} = $this->model::find($id);
        $show = $this->model::find($id);
        $title = trans('admin.show');
        return view("$this->view.show", compact($this->name, 'show', 'title'));
    }


    public function singleEdit($id)
    {
        $this->bottle();// Scaffold init ;)
        $p_name = Str::ucfirst($this->pluralName);
        ${$this->name} = $this->model::find($id);
        $edit = $this->model::find($id);
        $route = $this->route;
        $fields = $this->fields();
        $title = trans('admin.edit');
        $instance = $this;
        return view("$this->view.edit", compact($this->name, 'edit','instance', 'route', 'title', 'p_name', 'fields'));
    }


    public function singleUpdate($id)
    {
        $this->bottle();// Scaffold init ;)
        $this->validateUpdateRequest();

        $this->beforeUpdate();
        $data = $this->hashingFeilds($this->uploadFilesIfExist());
        $this->model::find($id)->update($data);

        $this->afterUpdate();

        session()->flash('success', trans('admin.updated'));

        return redirect(route("$this->route.index"));
    }


    public function singleDestroy($id)
    {
        $this->bottle();// Scaffold init ;)
        $this->beforeDestroy();

        ${$this->name}  = $this->model::find($id);
        $this->deleteFilesIfExist(${$this->name});
        ${$this->name}->delete();

        $this->afterDestroy();

        session()->flash('success', trans('admin.deleted'));

        return redirect(route("$this->route.index"));
    }
}
