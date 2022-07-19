<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\NovelsRepository;
use App\Repositories\NovelsRepositoryInterface;

class NovelsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(NovelsRepositoryInterface::class, NovelsRepository::class);
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
