<?php

namespace App\Providers;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
      Schema::defaultStringLength(191);
      Validator::extend('greater_than', function($attribute, $value, $params, $validator){
        $other = Input::get($params[0]);
        return intval($value) > intval($other);
      });

      Validator::replacer('greater_than', function($message, $attribute, $rule, $params) {
        return str_replace('_', ' ' , 'The '. $attribute .' must be greater than the ' .$params[0]);
      });
    }
}
