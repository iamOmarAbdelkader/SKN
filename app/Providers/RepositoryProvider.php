<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\ItemsRepositoryInterface;
use App\Repositories\ImagesRepositoryInterface;
use App\Repositories\ItemsRepository;
use App\Repositories\ImagesRepository;


class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->bind(
            ItemsRepositoryInterface::class , ItemsRepository::class
        );

        $this->app->bind(
            ImagesRepositoryInterface::class  , ImagesRepository::class
        );
    }
}
