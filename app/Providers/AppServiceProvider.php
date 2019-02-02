<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Comment;
use App\Product;
use App\Transaction;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //count bình luận mới
        $countNewComment = Comment::where('status',0)->count();
        //count đầu sách hết hàng
        $countOutOfStock = Product::where('quantity','=',0)->count();
        //count đơn hàng mới trả trước
        $countNewOrder = Transaction::where([
            ['status', '=', '1'],
            ['payment', '<>', '3']
        ])->count();
        //count đơn hàng mới COD
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
