<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->integer('user_id',false,true);
            $table->decimal('balance',10,2)->default(0);
            $table->decimal('frozen_fund',10,2)->default(0);
            $table->timestamps();

            $table->primary('user_id','pk_user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropPrimary('pk_user_id');
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('accounts');
    }
}
