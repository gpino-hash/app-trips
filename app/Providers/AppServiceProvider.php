<?php

namespace App\Providers;

use App\UseCase\Distance\IDistance;
use App\UseCase\Distance\ITotalDistance;
use App\UseCase\Distance\Distance;
use App\UseCase\Distance\TotalDistance;
use App\UseCase\Flight\CalculateFirstClass;
use App\UseCase\Flight\CalculatePrice;
use App\UseCase\Flight\Discount;
use App\UseCase\Flight\ICalculateFirstClass;
use App\UseCase\Flight\ICalculatePrice;
use App\UseCase\Flight\IDiscount;
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
        $this->app->bind(IDistance::class, Distance::class);
        $this->app->bind(ICalculatePrice::class, CalculatePrice::class);
        $this->app->bind(ICalculateFirstClass::class, CalculateFirstClass::class);
        $this->app->bind(IDiscount::class, Discount::class);
        $this->app->bind(ITotalDistance::class, TotalDistance::class);
        $this->app->bind(\App\UseCase\Flight\IScale::class ,\App\UseCase\Flight\Scale::class);
    }
}
