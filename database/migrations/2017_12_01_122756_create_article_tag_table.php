<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tag', function (Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->primary(['article_id','tag_id'],'pk_art_tag');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artile_tag',function (Blueprint $table) {
            $table->dropPrimary('pk_art_tag');
        });
        Schema::dropIfExists('article_tag');
    }
}
