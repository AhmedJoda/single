<?php

namespace Syscape\Single\Traits;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ReflectionClass;
trait SingleResources
{

    public function setModelName()
    {
        $reflector = new ReflectionClass($this);
        $this->model = $reflector->name;
    }

    public function initAttributeNames()
    {
        $this->bottle();// Scaffold init ;)

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
    public function getStoreRules(){
        $rules  = [];
        foreach ($this->fields() as $field){
            $rules[$field->getName()] = $field->getStoreRules();
        }
        return $rules;
    }
    public function getUpdateRules(){
        $rules  = [];
        foreach ($this->fields() as $field){
            $rules[$field->getName()] = $field->getUpdateRules();
        }
        return $rules;
    }

    public function validateUpdateRequest()
    {
        request()->validate($this->getUpdateRules());
    }
    protected function hashingFeilds($data){
        foreach ($this->fields() as $field){
            if ($field->hashIt() and $data[$field->getName()]){
                $data[$field->getName()] = Hash::make($data[$field->getName()]);
            }elseif ($field->hashIt()){
                unset($data[$field->getName()]);
            }
        }
        return $data;
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
