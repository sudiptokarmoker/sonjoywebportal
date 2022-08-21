<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\StoriesRepository;
use App\Repositories\StoriesRepositoryInterface;

class StoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StoriesRepositoryInterface::class, StoriesRepository::class);
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
