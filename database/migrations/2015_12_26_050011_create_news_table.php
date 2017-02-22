<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("news",function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->string('description');
            $table->string('content');
            $table->Integer('view');
            $table->string('user');
            $table->string('categoryNewsID');
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
        Schema::drop("news");
    }
}
