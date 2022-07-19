<?php

namespace App\Providers;

use App\Repositories\CourseSectionFilesRepository;
use App\Repositories\CourseSectionFilesRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CourseSectionFilesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CourseSectionFilesRepositoryInterface::class, CourseSectionFilesRepository::class);
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
