<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Infrastructure\Interfaces\UserInterface::class,
            \App\Infrastructure\Repositories\UserRepository::class,
        );
        $this->app->bind(
            \App\Infrastructure\Interfaces\TaskInterface::class,
            \App\Infrastructure\Repositories\TaskRepository::class,
        );
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
