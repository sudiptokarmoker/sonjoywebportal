<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ArtistsRepository;
use App\Repositories\ArtistsRepositoryInterface;

class ArtistsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArtistsRepositoryInterface::class, ArtistsRepository::class);
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
