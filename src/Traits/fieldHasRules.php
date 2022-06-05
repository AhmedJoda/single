<?php


namespace Syscape\Single\Traits;


trait fieldHasRules
{
    protected $field_store_rules = [];
    protected $field_update_rules = [];
    # setters
    public function required($store_only = false){
        $this->addRule('required',$store_only);
        return $this;
    }
    public function nullable($store_only = false){
        $this->addRule('nullable',$store_only);
        return $this;
    }
    public function sometimes($store_only = false){
        $this->addRule('sometimes',$store_only);
        return $this;
    }
    public function addRule($rule,bool $store_only = false){
        array_push($this->field_store_rules,$rule);
        if (! $store_only)
            array_push($this->field_update_rules,$rule);
        return $this;
    }
    public function rules($rules,$update_rules = null){
        $this->field_store_rules = $rules;
        $this->field_update_rules = ($update_rules ? $update_rules : $rules);
        return $this;
    }
    # getters
    public function getStoreRules(){
        return $this->field_store_rules;
    }
    public function getUpdateRules(){
        return $this->field_update_rules;
    }

}
