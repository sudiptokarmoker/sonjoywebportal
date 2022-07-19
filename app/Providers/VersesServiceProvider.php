<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\VersesRepository;
use App\Repositories\VersesRepositoryInterface;

class VersesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VersesRepositoryInterface::class, VersesRepository::class);
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
