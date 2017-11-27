<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2017/11/25
 * Time: 20:55
 */

namespace App\Services;

/**
 * 支付服务
 *
 * Class PayService
 * @package App\Services
 */
class PayService
{
    public function pay($order_id) {
        echo "pay for order_id=$order_id<br/>";
    }

    public function refund($return_id) {
        echo "refund for return_id=$return_id<br/>";
    }

    public function callback() {
        echo "pay callback <br />";
    }

    public function notify() {
        echo "pay notify <br/>";
    }
}