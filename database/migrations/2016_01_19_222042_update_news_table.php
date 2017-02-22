<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            //$table->Integer('categoryNewsID')->unsigned();
            $table->tinyInteger('display');
        });

        DB::statement("ALTER TABLE detailproduct modify silebar_images varchar(2000) collate utf8_unicode_ci");
        DB::statement("ALTER TABLE news modify content text collate utf8_unicode_ci");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            //
        });
    }
}
