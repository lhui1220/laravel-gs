<?php

use App\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100*10000;$i++) {
            $order = [
                'id' => $i + 1,
                'order_no' => uniqid(),
                'order_price' => mt_rand(1,1000000),
                'addr' => str_random(64),
                'consignee' => str_random()
            ];
            Order::insert($order);
            $num_goods = mt_rand(1,5);

            $goodsList = [];
            for ($j = 0; $j < $num_goods; $j++) {
                $goodsList[] = [
                    'goods_id' => mt_rand(1,1000000),
                    'order_id' => $order['id'],
                    'order_no' => $order['order_no'],
                    'price' => mt_rand(1,1000000),
                    'goods_name' => str_random(32),
                    'goods_img' => str_random(32),
                    'qty' => mt_rand(1,5)
                ];
            }
            \App\OrderGoods::insert($goodsList);
        }
    }
}
