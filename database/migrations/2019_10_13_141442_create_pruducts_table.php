<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePruductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pruducts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->default('imgProduct.png');
            $table->double('purchase_price');
            $table->double('sale_price');
            $table->integer('stoke');
            $table->integer('category_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pruducts');
    }
}
