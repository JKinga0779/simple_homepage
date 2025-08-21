<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companyinfos', function (Blueprint $table) {           

            $table->string('site_background_color')->default('#FFFFFF')->after('note');    
            $table->integer('nav_color')->default(1)->after('site_background_color');  //1.white 2.black
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companyinfos', function (Blueprint $table) {

            $table->dropColumn('site_background_color');
            $table->dropColumn('nav_color');
        });
    }
};
