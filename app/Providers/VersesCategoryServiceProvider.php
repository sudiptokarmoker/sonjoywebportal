<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\VersesCategoryRepository;
use App\Repositories\VersesCategoryRepositoryInterface;

class VersesCategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VersesCategoryRepositoryInterface::class, VersesCategoryRepository::class);
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
