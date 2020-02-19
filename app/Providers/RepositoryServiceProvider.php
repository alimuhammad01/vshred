<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\UserRepository;
use App\Repository\BaseRepository;
use App\Repository\ImageRepository;
use App\Repository\ImageRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
