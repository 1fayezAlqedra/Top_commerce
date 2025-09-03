<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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



        app()->setLocale('ar'); // يجبر العربية بكل الطلبات


        Schema::defaultStringLength(121);
        Paginator::useBootstrapFive();
    }
}
