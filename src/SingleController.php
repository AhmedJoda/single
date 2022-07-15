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
    protected $single_item;
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
    public function filterCalled(){
        foreach ($this->filters() as $filter){
            if ($filter->called()){
                return $filter;
            }
        }
    }

    public function singleIndex()
    {
        $this->bottle();// Scaffold init ;)
        if ($filter = $this->filterCalled()){
            ${$this->pluralName} = $filter->getQuery()->get();
        }else{
            if (method_exists($this, 'singleQuery')) {
                ${$this->pluralName} = $this->singleQuery($this->model::query())->get();
            } else {
                ${$this->pluralName} = $this->model::all();
            }
        }
        $p_name = Str::ucfirst($this->pluralName);
        $index = ${$this->pluralName};
        $route = $this->route;
        $title = $this->getIndexTitle();
        $table = Table::make($this->fields())->data(${$this->pluralName})->model($this->model)->route($route);
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

        $this->single_item = $this->model::create($data);
        
        $this->afterStore();

        session()->flash('success', trans('admin.added'));

        return redirect(route("$this->route.index"));
    }


    public function singleShow($id)
    {
        $this->bottle();// Scaffold init ;)
        ${$this->pluralName} = $this->model::find($id);
        $show = $this->model::find($id);
        $title = trans('admin.show');
        return view("$this->view.show", compact($this->pluralName, 'show', 'title'));
    }


    public function singleEdit($id)
    {
        $this->bottle();// Scaffold init ;)
        $p_name = Str::ucfirst($this->pluralName);
        ${$this->pluralName} = $this->model::find($id);
        $edit = $this->model::find($id);
        $route = $this->route;
        $fields = $this->fields();
        $title = trans('admin.edit');
        $instance = $this;
        return view("$this->view.edit", compact($this->pluralName, 'edit','instance', 'route', 'title', 'p_name', 'fields'));
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

        ${$this->pluralName}  = $this->model::find($id);
        $this->deleteFilesIfExist(${$this->pluralName});
        ${$this->pluralName}->delete();

        $this->afterDestroy();

        session()->flash('success', trans('admin.deleted'));

        return redirect(route("$this->route.index"));
    }
}
