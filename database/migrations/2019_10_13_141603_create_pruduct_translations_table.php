<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePruductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pruduct_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pruduct_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->string('locale')->index();

            $table->unique(['pruduct_id','locale']);
            $table->foreign('pruduct_id')->references('id')->on('pruducts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pruduct_translations');
    }
}
