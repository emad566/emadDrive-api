<?php

namespace App\Providers;

use App\Models\Passenger;
use App\Models\BusinessGroupMember;
use App\Observers\PassengerObserver;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Mockery\Generator\StringManipulation\Pass\Pass;

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

    }
}
