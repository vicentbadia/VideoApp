<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Registrar el cambio de la carpeta public por httpdocs:
        $this->app->bind('path.public', function() {
            return base_path().'/httpdocs';
        });
    }
}
