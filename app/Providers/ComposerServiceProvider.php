<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ComposerRepository;
use App\Repositories\ComposerRepositoryInterface;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ComposerRepositoryInterface::class, ComposerRepository::class);
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
