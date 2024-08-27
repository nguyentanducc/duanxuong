<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();
        view()->composer('*',function($view){
            $categories = Category::all();
            $view->with(compact('categories'));
            view()->composer('*', function ($view) {
                $categories = Category::all();
                $carts = session('cart') ?? [];
                $total_money = 0;
                $count = 0;
                if ($carts) {
                    foreach ($carts as $cart) {
                        $total_money += ($cart['sale_price'] ?? $cart['price']) * $cart['quantity'];
                        $count += $cart['quantity'];
                    }
                }
    
    
                $view->with(compact('categories', 'count', 'total_money'));
            });
        });
    }
}
