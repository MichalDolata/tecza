<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // slug:table,ignore_id
        Validator::extend('slug', function ($attribute, $value, $parameters, $validator) {
            $table = $attribute;
            $ignore = 0;

            switch (count($parameters)) {
                case 2:
                    $ignore = $parameters[1];
                case 1:
                    $table = $parameters[0];
            }

            $count = DB::table($table)
                ->where('slug', str_slug($value))
                ->where('id', '<>', $ignore)
                ->count();


            return $count === 0;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
