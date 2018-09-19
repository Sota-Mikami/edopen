<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Validator;
use App\Http\Validators\UserCustomValidator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $validator = $this->app['validator'];
        $validator->resolver(function($translator, $data, $rules, $messages){
            return new UserCustomValidator($translator, $data, $rules, $messages);
        });
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
