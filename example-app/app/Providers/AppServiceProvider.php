<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Product;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Model\Restaurant;
use App\Repositories\RestaurantRepository;
use App\Model\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RestaurantRepository::class, function ($app) {
            return new RestaurantRepository(Restaurant::class);
        });

        $this->app->bind(ProductRepository::class, function ($app) {
            return new ProductRepository(Product::class);
        });

        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository(User::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
