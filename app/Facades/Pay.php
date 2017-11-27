<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2017/11/25
 * Time: 21:02
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Pay extends Facade
{
    /**
     * 返回注册到服务容器的服务名称
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pay';
    }
}