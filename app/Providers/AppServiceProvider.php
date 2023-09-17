<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
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
        Schema::defaultStringLength(191);

        Builder::macro('search', function ($field, $string) {
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
        });

        Builder::macro('orSearch', function ($field, $string) {
            return $string ? $this->orWhere($field, 'like', '%'.$string.'%') : $this;
        });

        Builder::macro('active', function () {
            return $this->where('status', 1);
        });

        Builder::macro('inActive', function () {
            return $this->where('status', 0);
        });

        Builder::macro('available', function () {
            return $this->where('available', 1);
        });

        Builder::macro('inAvailable', function () {
            return $this->where('available', 0);
        });


        Builder::macro('onActive', function () {
            return $this->where('is_active', 1);
        });

        Builder::macro('offActive', function () {
            return $this->where('is_active', 0);
        });
    }
}
