<?php

namespace App\Providers;

use App\Repositories\{
    CategoryRepository,
    UserRepository,
};
use App\Repositories\Interfaces\{
    CategoryRepositoryInterface,
    UserRepositoryInterface,
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**
         * This line acts as a "bridge" so Laravel knows:
         * whenever this Interface is requested, provide that Class implementation
         */
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
