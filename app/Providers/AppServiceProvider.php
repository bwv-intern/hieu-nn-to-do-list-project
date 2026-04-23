<?php

namespace App\Providers;

<<<<<<< HEAD
=======
use App\Repositories\{
    CategoryRepository,
    UserRepository,
    TaskRepository,
};
use App\Repositories\Interfaces\{
    CategoryRepositoryInterface,
    UserRepositoryInterface,
    TaskRepositoryInterface,
};
>>>>>>> release/v1.0.0
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
<<<<<<< HEAD
        //
=======
        /**
         * This line acts as a "bridge" so Laravel knows:
         * whenever this Interface is requested, provide that Class implementation
         */
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
>>>>>>> release/v1.0.0
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
