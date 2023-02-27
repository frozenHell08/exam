<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        /**
         * sets the default string length to avoid the queryexception : syntax error or access violation: 1071
         * specified key too long (referring to the email default of the users table)
         */
        Schema::defaultStringLength(191);
    }
}
