<?php

namespace App\Providers;

use App\Services\Contracts\MunicipalServiceContract;
use App\Services\Contracts\UserPointServiceContract;
use App\Services\MunicipalService;
use App\Services\UserPointService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserPointServiceContract::class, UserPointService::class);
        $this->app->bind(MunicipalServiceContract::class, MunicipalService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
