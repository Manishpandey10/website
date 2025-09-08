<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use Surfsidemedia\Shoppingcart\Facades\Cart as Cart;


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
        View::composer('*', function ($view) {
        $view->with('cartdata', Cart::content());
        $view->with('total', Cart::total());
        $view->with('subtotal', Cart::subtotal());
        $view->with('tax', Cart::tax());
        $view->with('count', Cart::count());
    });
    }
}
