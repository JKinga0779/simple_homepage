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
        Schema::table('products', function (Blueprint $table) {           

            $table->integer('sales_num')->default(0)->after('type_id');
            $table->integer('stores_num')->default(0)->after('type_id');
            $table->string('card_background_img_herf')->nullable()->after('bgimg_herf');            
            $table->string('card_background_color')->default('#FFFFFF')->after('card_background_img_herf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn('sales_num');
            $table->dropColumn('stores_num');
            $table->dropColumn('card_background_img_herf');
            $table->dropColumn('card_background_color');
        });
    }
};
