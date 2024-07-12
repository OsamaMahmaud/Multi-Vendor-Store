<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Faker\Factory;
use App\Faker\CustomProvider;


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
        JsonResource::withoutWrapping();//resouce api

        Paginator::useBootstrapFour();

        $this->app->extend('Faker\Generator', function () {
            $faker = Factory::create();
            $faker->addProvider(new CustomProvider());
            return $faker;
        });
    }
}
