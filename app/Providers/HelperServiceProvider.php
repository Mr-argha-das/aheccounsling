<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Helpers\Design;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Design::inti();

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(app_path()."/Helpers/*.php") as $filename){
        //require_once($filename);
        };

    }
}
