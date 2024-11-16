<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*parent::boot();*/

        /*Validator::extend('unique_except_admin_email', function ($attribute, $value, $parameters) {
            $count = User::where('email', $value)->count();
            return $count === 0 || $value === 'createdbyadmin@hospital.org';
        });*/
    }
}
