<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->string('order_no',32);
            $table->unsignedInteger('goods_id');
            $table->unsignedDecimal('price',10,2);
            $table->string('goods_name',128);
            $table->string('goods_img',64);
            $table->unsignedInteger('qty');
            $table->timestamps();
            $table->index('order_id','idx_order_id');
            $table->index('order_no','idx_oder_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_goods');
    }
}
