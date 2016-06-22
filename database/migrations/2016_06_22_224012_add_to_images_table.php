<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table)
        {
            $table->integer('product_id')->unsigned()->index();
            $table->integer('article_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table)
        {
            $table->dropColumn(['product_id', 'article_id', 'user_id']);
        });
    }
}
