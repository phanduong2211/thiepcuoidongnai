<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('promotion_price');
            $table->string('price');
            $table->string('image');
            $table->integer('quantity');
            $table->string('status');
            $table->integer('view');
            $table->text('content');
            $table->integer('user');
            $table->integer('tab_categoryID');
            $table->integer('categoryID');
            $table->integer('tagID');
            $table->Integer('menuID');
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
        Schema::drop('product');
    }
}
