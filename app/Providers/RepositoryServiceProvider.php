<?php

namespace App\Providers;

use App\Repositories\Contracts\EtudiantRepositoryInterface;
use App\Repositories\Eloquent\EtudiantsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Enregistre les liaisons entre Interfaces et Repositories.
     */
    public function register(): void
    {
        $this->app->bind(
            EtudiantRepositoryInterface::class,
            EtudiantsRepository::class
        );
    }

    /**
     * Initialisation des services.
     */
    public function boot(): void
    {
        //
    }
}