<?php

namespace Ahmedjoda\Single;

use Ahmedjoda\Single\Traits\SingleResources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
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




    public function fields(): array { return []; }

    public function SingleCreate()
    {
        $p_name = Str::ucfirst($this->pluralName);
        $route = $this->route;
        $title = trans('admin.create');
        $fields = $this->fields();
        return view($this->setCreateView(), compact('route', 'title','p_name','fields'));
    }


    public function singleStore()
    {

        $this->validateStoreRequest();
        $fields = $this->formFields();
        $this->beforeStore();
        $data = $this->uploadFilesIfExist();
//        $this->model::create($data);

        DB::table($this->table ?? $this->pluralName)->insert($data);
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
        return view("$this->view.edit", compact($this->name, 'edit', 'route', 'title','p_name','fields'));
    }


    public function singleUpdate($id)
    {
        $this->validateUpdateRequest();

        $this->beforeUpdate();
        $fields = $this->formFields();
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
        foreach ($this->fields() as $field){
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
    public function setCreateView(){
        return 'single::master.create';
    }
    protected function formFields(){
        return [];
    }
    protected function tableColumns(){
        return [];
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
