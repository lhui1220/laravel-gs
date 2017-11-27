<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2017/11/25
 * Time: 20:59
 */

namespace App\Providers;

use App\Services\PayService;
use Illuminate\Support\ServiceProvider;

class PayServiceProvider extends ServiceProvider
{
    /**
     * 注册支付服务到服务容器中
     */
    public function register() {

        $this->app->singleton('pay', function ($app){
            echo "new pay service<br/>";
            return new PayService();
        });
    }

}