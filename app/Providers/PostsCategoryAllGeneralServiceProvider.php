<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\PostsCategoryAllGeneralRepository;
use App\Repositories\PostsCategoryAllGeneralRepositoryInterface;

class PostsCategoryAllGeneralServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostsCategoryAllGeneralRepositoryInterface::class, PostsCategoryAllGeneralRepository::class);
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
