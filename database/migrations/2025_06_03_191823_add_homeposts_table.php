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
        Schema::table('homeposts', function (Blueprint $table) {
            
            $table->integer('card_background_type')->default('1')->after('btn_herf_6'); //1.卡片顏色 2.圖片(上傳) 3.商品個別設定
            $table->string('card_background_color')->default('#FFFFFF')->after('card_background_img');
            $table->string('card_text_color')->default('#000000')->after('card_background_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homeposts', function (Blueprint $table) {

            $table->dropColumn('background_herf');
            $table->dropColumn('card_background_type');
            $table->dropColumn('card_background_color');
            $table->dropColumn('card_text_color');
        });
    }
};
