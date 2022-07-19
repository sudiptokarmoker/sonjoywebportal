<?php

namespace App\Providers;

use App\Repositories\CourseSectionRepository;
use App\Repositories\CourseSectionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CourseSectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CourseSectionRepositoryInterface::class, CourseSectionRepository::class);
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
