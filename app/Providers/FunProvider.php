<?php

namespace App\Providers;

use App\Repositories\SqlPatientRepository;
use Illuminate\Support\ServiceProvider;

use John\Fun\Application\PatientRepository;
use John\Fun\Application\RegisterPatient;
use John\Fun\Core\SsnFactory;


class FunProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(PatientRepository::class, SqlPatientRepository::class);

        $this->app->bind(RegisterPatient::class, function ($app) {
            return new RegisterPatient($app->make(SsnFactory::class), $app->make(PatientRepository::class));
        });
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
