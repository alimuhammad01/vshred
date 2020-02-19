<?php

namespace App\Repository;

use App\Image;
use App\Repository\ImageRepositoryInterface;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{

    /**
     * ImageRepository constructor.
     *
     * @param Image $model
     */
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }
}
