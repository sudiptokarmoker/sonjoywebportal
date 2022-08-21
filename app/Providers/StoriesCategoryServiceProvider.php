<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\StoriesCategoryRepository;
use App\Repositories\StoriesCategoryRepositoryInterface;

class StoriesCategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StoriesCategoryRepositoryInterface::class, StoriesCategoryRepository::class);
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
