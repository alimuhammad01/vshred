<?php

namespace App\Repository;

use App\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    // /**
    //  * @return Collection
    //  */
    // public function all(): Collection
    // {
    //     return $this->model->all();
    // }

    // /**
    //  * @param array $attributes
    //  *
    //  * @return Model
    //  */
    // public function create(array $attributes): User
    // {
    //     return $this->model->create($attributes);
    // }

    // /**
    //  * @param $id,array $attributes
    //  *
    //  * @return Model
    //  */
    // public function update($id, array $attributes): ?User
    // {
    //     $instance = $this->model->find($id);
    //     $instance->fill($attributes);
    //     $instance->save();
    //     return $instance;
    // }

    // /**
    //  * @param $id
    //  * @return Model
    //  */
    // public function find($id): ?User
    // {
    //     return $this->model->find($id);
    // }

    // /**
    //  * @param $id
    //  * @return Boolean
    //  */
    // public function delete($id): ?User
    // {
    //     return $this->model->find($id)->delete();
    // }
}
