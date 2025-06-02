<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Contracts\LivroRepositoryInterface::class,
            \App\Repositories\LivroRespository::class,
        );

        $this->app->bind(
            \App\Repositories\Contracts\AutorRepositoryInterface::class,
            \App\Repositories\AutorRespository::class,
        );

        $this->app->bind(
            \App\Repositories\Contracts\AssuntoRepositoryInterface::class,
            \App\Repositories\AssuntoRespository::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
