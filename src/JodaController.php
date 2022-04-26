<?php

namespace Ahmedjoda\Single;

use Ahmedjoda\Single\Trait\SingleResources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use ReflectionClass;
use Illuminate\Http\Request;

class JodaController extends Model
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, SingleResources;

    final public function __construct()
    {
        $this->setModelName();
        $this->initAttributeNames();
    }



    


    public function SingleCreate()
    {
        $route = $this->route;
        $title = trans('admin.create');
        return view("{$this->view}.create", compact('route', 'title'));
    }


    public function singleStore()
    {
        $this->validateStoreRequest();
        
        $this->beforeStore();
        $data = $this->uploadFilesIfExist();
        $this->model::create($data);

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
        ${$this->name} = $this->model::find($id);
        $edit = $this->model::find($id);
        $route = $this->route;
        $title = trans('admin.edit');
        return view("$this->view.edit", compact($this->name, 'edit', 'route', 'title'));
    }


    public function singleUpdate($id)
    {
        $this->validateUpdateRequest();
        
        $this->beforeUpdate();

        $data = $this->uploadFilesIfExist();
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
        $rules = isset($this->model::$storeRules) ? $this->model::$storeRules :
            (isset($this->model::$rules) ? $this->model::$rules : null);
        if ($rules) {
            request()->validate($rules);
        }
    }
    
    public function validateUpdateRequest()
    {
        $rules = isset($this->model::$updateRules) ? $this->model::$updateRules :
            (isset($this->model::$rules) ? $this->model::$rules : null);
        if ($rules) {
            request()->validate($rules);
        }
    }

    public function uploadFilesIfExist()
    {
        $data = request()->except("_token", '_method');
        if (isset($this->files)) {
            foreach ($this->files as $file) {
                if (request()->hasFile($file) and request()->$file) {
                    $fileName =
                        (auth()->user() ? auth()->user()->id : '') . '-' .
                        time() . '.' .
                        request()->file($file)->getClientOriginalExtension();
                    $filePath = "$this->pluralName/$fileName";
                    $data[$file] = $filePath;
                    Storage::disk('local')->put($filePath, file_get_contents(request()->$file));
                }
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
