<?php

namespace App\Providers;

use App\Contest;
use App\ContestTable;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

        Route::resourceVerbs([
            'create' => 'dodaj',
            'edit' => 'edytuj',
        ]);

        \Carbon\Carbon::setLocale(config('app.locale'));


        view()->composer('partials.page.sidebar', function($view) {
            $contest = Contest::find(1);
            $view->with('table', new ContestTable($contest->clubs, $contest->matches));
            $view->with('contest', $contest);
        });
/*        \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
            var_dump($query->sql);
            var_dump($query->bindings);
            var_dump($query->time);
        });*/
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
