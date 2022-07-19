<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\PostsCategoryRepository;
use App\Repositories\PostsCategoryRepositoryInterface;

class PostsCategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostsCategoryRepositoryInterface::class, PostsCategoryRepository::class);
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
