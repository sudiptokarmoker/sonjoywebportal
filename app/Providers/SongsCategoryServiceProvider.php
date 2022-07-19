<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SongsCategoryRepository;
use App\Repositories\SongsCategoryRepositoryInterface;

class SongsCategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SongsCategoryRepositoryInterface::class, SongsCategoryRepository::class);
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
