<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Comment;
use App\Product;
use App\Transaction;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $countNewComment = Comment::where('status',0)->count();
        $countOutOfStock = Product::where('quantity','=',0)->count();
        $countNewOrder = Transaction::where([
            ['status', '=', '1'],
            ['payment', '<>', '3']
        ])->count();
        $countNewOrderCOD = Transaction::where([
            ['status', '=', '1'],
            ['payment', '=', '3']
        ])->count();
        view()->share('countNewComment', $countNewComment);
        view()->share('countOutOfStock', $countOutOfStock);
        view()->share('countNewOrder', $countNewOrder);
        view()->share('countNewOrderCOD', $countNewOrderCOD);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
