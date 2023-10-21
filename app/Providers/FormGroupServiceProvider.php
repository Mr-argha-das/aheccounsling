<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;
class FormGroupServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.form.text', ['name', 'value' => null, 'attributes' => []]);
        Form::component('bsTextarea', 'components.form.textarea', ['name', 'value' => null, 'attributes' => []]);
        Form::component('bsView', 'components.form.view', ['name', 'value' => null, 'attributes' => []]);
        Form::component('bsSelect', 'components.form.select', ['name','options','value' => null, 'attributes' => []]);
        Form::component('bsSubmit', 'components.form.submit', ['name' => null, 'attributes' => []]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
