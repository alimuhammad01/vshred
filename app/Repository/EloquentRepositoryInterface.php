<?php

namespace App\Repository;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param array $attributes
     * @return Model
     */
    public function update($id, array $attributes): ?Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;

    /**
     * @return Model
     */
    public function all(): ?Collection;


    /**
     * @param $id
     * @return Model
     */
    public function delete($id): ?Boolean;
}
