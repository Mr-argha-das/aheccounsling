<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL; 


/*By AV*/
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //by AV
         URL::forceScheme('https');
        View::share('timedate',  new \App\Library\Timedate);
        View::share('commonModel',  new \App\Model\Common);
    }
}
