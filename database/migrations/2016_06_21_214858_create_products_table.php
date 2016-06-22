<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateproductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('short_description')->default('short_description');
            $table->string('description')->default('description');
            $table->float('price')->default('20.00');
            $table->integer('quantity_on_hand')->default(20);
            $table->integer('quantity_available')->default(20);
            $table->string('product_name')->nullable();
            $table->string('product_image')->nullable();
            $table->timestamp('pubished_at')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
