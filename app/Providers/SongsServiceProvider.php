<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SongsRepository;
use App\Repositories\SongsRepositoryInterface;

class SongsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SongsRepositoryInterface::class, SongsRepository::class);
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
