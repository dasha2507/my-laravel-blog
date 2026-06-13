<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class CoreRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * Повинен повернути назву класу моделі (наприклад, BlogPost::class).
     *
     * @return string
     */
    abstract protected function getModelClass();

    /**
     * Повертає новий екземпляр моделі для початку побудови запиту до бази.
     *
     * @return Model|\Illuminate\Foundation\Application|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }
}
