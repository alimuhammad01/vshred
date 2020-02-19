<?php

namespace App\Repository;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id,array $attributes
     *
     * @return Model
     */
    public function update($id, array $attributes): ?Model
    {
        $instance = $this->model->findOrFail($id);
        $instance->fill($attributes);
        $instance->save();
        return $instance;
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @return Model
     */
    public function all(): ?Collection
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return Boolean
     */
    public function delete($id): ?Boolean
    {
        return $this->model->findOrFail($id)->delete();
    }
}
