<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2017/11/25
 * Time: 21:04
 */

namespace App\Http\Controllers;

use App\Facades\Pay;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function pay(Request $req) {
        $order_id = $req->input('order_id', 0);
        Pay::pay($order_id);
        Pay::callback();
        Pay::notify();
    }

    public function refund(Request $req) {
        $return_id = $req->input('return_id', 0);
        Pay::refund($return_id);
    }

    public function callback(Request $req) {
        Pay::callback();
    }

    public function notify(Request $req) {
        Pay::notify();
    }

}