<?php

namespace App\Repositories;

class Repository {
    
    public $model;
    
    public $primaryKey = 'id';
    
    public function model()
    {
        try {
            return $this->model = app()->make($this->model);
        } catch (\ReflectionException $e) {
            return abort(500, 'Model does not exists, please define correct model at $model');
        }
    }
    
    public function all()
    {
        return $this->model();
    }
    
    public function find($field, $value = null)
    {
        if (!empty($value)) {
            return $this->model->where($field, $value)
                ->get()
                ->toArray();
        }
        
        try {
            return $this->model->findOrFail($field)
                ->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
    
    public function save($saveData)
    {
        if (!array_key_exists($this->primaryKey, $saveData)) {
            return $this->model->create($saveData); 
        }
        
        return $this->model->where($this->primaryKey, $saveData['id'])
            ->update($saveData);
    }
    
    public function delete($deleteId)
    {
        return $this->model->where($this->primaryKey, $deleteId)
            ->delete();
    }
}