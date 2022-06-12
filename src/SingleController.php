<?php

namespace Syscape\Single;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Syscape\Single\Scaffold\Tables\Table;
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
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, SingleResources;
    public $model;
    public $pluralName;
    public $name;
    public $route;

    final public function __construct()
    {
        $this->setModelName();
        $this->initAttributeNames();
    }

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
        $title = $this->getIndexTitle();
        $table = Table::make($this->fields())->model($this->model)->route($route);
        return view("{$this->view}.index", compact($this->pluralName, 'index', 'title', 'route', 'p_name', 'table'));
    }
    public function getIndexRoute()
    {
        return $this->route.'.index';
    }
    public function getIndexTitle()
    {
        return __($this->route);
    }


   

    public function SingleCreate()
    {
        $p_name = Str::ucfirst($this->pluralName);
        $route = $this->route;
        $title = trans('admin.create');
        $fields = $this->fields();
        return view($this->setCreateView(), compact('route', 'title', 'p_name', 'fields'));
    }

    protected function hashingFelids($data)
    {
        foreach ($this->fields() as $field) {
            if ($field->hashIt() and $data[$field->getName()]) {
                $data[$field->getName()] = Hash::make($data[$field->getName()]);
            }
        }
        return $data;
    }
    public function singleStore()
    {
        $this->validateStoreRequest();
        $this->beforeStore();
        $data = $this->hashingFelids($this->uploadFilesIfExist());

        $model = new $this->model;
        $model->fill($data);
        $model->save();
        
        $this->afterStore();

        session()->flash('success', trans('admin.added'));

        return redirect(route("$this->route.index"));
    }


    public function singleShow($id)
    {
        ${$this->name} = $this->model::find($id);
        $show = $this->model::find($id);
        $title = trans('admin.show');
        return view("$this->view.show", compact($this->name, 'show', 'title'));
    }


    public function singleEdit($id)
    {
        $p_name = Str::ucfirst($this->pluralName);
        ${$this->name} = $this->model::find($id);
        $edit = $this->model::find($id);
        $route = $this->route;
        $fields = $this->fields();
        $title = trans('admin.edit');
        return view("$this->view.edit", compact($this->name, 'edit', 'route', 'title', 'p_name', 'fields'));
    }


    public function singleUpdate($id)
    {
        $this->validateUpdateRequest();

        $this->beforeUpdate();
        $data = $this->hashingFelids($this->uploadFilesIfExist());
        $this->model::find($id)->update($data);

        $this->afterUpdate();

        session()->flash('success', trans('admin.updated'));

        return redirect(route("$this->route.index"));
    }


    public function singleDestroy($id)
    {
        $this->beforeDestroy();

        ${$this->name}  = $this->model::find($id);
        $this->deleteFilesIfExist(${$this->name});
        ${$this->name}->delete();

        $this->afterDestroy();

        session()->flash('success', trans('admin.deleted'));

        return redirect(route("$this->route.index"));
    }

    public function setModelName()
    {
        $reflector = new ReflectionClass($this);
        $this->model = $reflector->name;
    }

    public function initAttributeNames()
    {
        $array = explode('\\', Str::lower($this->model));
        $name = end($array);

        if (!isset($this->name)) {
            $this->name = $name;
            $this->pluralName = Str::plural($this->name);
        }

        $reflector = new ReflectionClass($this);
        $namespace = Str::lower(str_replace('App\Singles\\', '', $reflector->getNamespaceName()));
        $prefix = str_replace('app\singles', '', $namespace);

        if (!isset($this->view)) {
            if ($prefix) {
                $this->view = "$prefix.$name";
            } else {
                $this->view = $name;
            }
        }

        if (!isset($this->route)) {
            $this->route = "$namespace.$this->pluralName"  ;
        }
    }


    public function validateStoreRequest()
    {
        request()->validate($this->getStoreRules());
    }
    public function getStoreRules()
    {
        $rules  = [];
        foreach ($this->fields() as $field) {
            $rules[$field->getName()] = $field->getStoreRules();
        }
        return $rules;
    }
    public function getUpdateRules()
    {
        $rules  = [];
        foreach ($this->fields() as $field) {
            $rules[$field->getName()] = $field->getUpdateRules();
        }
        return $rules;
    }

    public function validateUpdateRequest()
    {
        request()->validate($this->getUpdateRules());
    }

    public function uploadFilesIfExist()
    {
        $data = request()->except("_token", '_method');
        foreach ($this->fields() as $field) {
            if ($field->isFile() and request()->hasFile($field->getName()) and request($field->getName())) {
                $fileName =
                    (auth()->user() ? auth()->user()->id : '') . '-' .
                    time() . '.' .
                    request()->file($field->getName())->getClientOriginalExtension();
                $filePath = "$this->pluralName/$fileName";
                $data[$field->getName()] = $filePath;
                Storage::disk(config('single.app.filesystem-disk'))->put($filePath, file_get_contents(request($field->getName())));
            }
        }
        return $data;
    }
    public function deleteFilesIfExist($model)
    {
        if (isset($this->files)) {
            foreach ($this->files as $file) {
                Storage::delete($model->$file);
            }
        }
    }
    public function setCreateView()
    {
        return 'single::master.create';
    }
    public function beforeStore()
    {
    }

    public function afterStore()
    {
    }
    public function beforeUpdate()
    {
    }

    public function afterUpdate()
    {
    }
    public function beforeDestroy()
    {
    }

    public function afterDestroy()
    {
    }
}
