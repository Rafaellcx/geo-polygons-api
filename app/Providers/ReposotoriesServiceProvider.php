<?php

namespace App\Providers;

use App\Repositories\Contracts\UserPointRepositoryContract;
use App\Repositories\UserPointRepository;
use Illuminate\Support\ServiceProvider;

class ReposotoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserPointRepositoryContract::class, UserPointRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
