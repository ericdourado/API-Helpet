<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository 
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function getResultado()
    {
        return $this->model->get();
    }
}