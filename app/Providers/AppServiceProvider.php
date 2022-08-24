<?php

namespace App\Providers;

use App\Services\ResumeService;
use App\Services\ResumeServiceInterface;
use App\Services\SkillService;
use App\Services\SkillServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SkillServiceInterface::class, SkillService::class);
        $this->app->bind(ResumeServiceInterface::class, ResumeService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
