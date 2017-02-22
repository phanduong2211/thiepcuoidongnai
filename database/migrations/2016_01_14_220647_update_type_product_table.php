<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTypeProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE detailproduct modify images varchar(2000)");
            DB::statement("ALTER TABLE detailproduct modify infomation text collate utf8_unicode_ci");
            DB::statement("ALTER TABLE detailproduct modify data_sheet text collate utf8_unicode_ci");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detailproduct', function (Blueprint $table) {
            //
        });
    }
}
