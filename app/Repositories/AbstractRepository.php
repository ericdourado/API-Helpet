<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository 
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function selectAtributosRegistrosRelacionados($atributos)
    {
        $this->model = $this->model->with($atributos);
    }
    public function getResultado()
    {
        return $this->model->get();
    }
}