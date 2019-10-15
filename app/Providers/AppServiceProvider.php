<?php

namespace App\Providers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Schema;
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
        if(!session()->has('lang')) {
            session(['lang' => 'ar']);
        }
        app()->singleton('lang',function(){
            if(session()->has('lang'))
                return session()->get('lang');
        });
        Schema::defaultStringLength(191);

        //
    }
}
