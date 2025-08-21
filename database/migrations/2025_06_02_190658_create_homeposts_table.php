<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeposts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('post_type'); //1~6
            $table->integer('post_order'); //1~20

            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('text_color')->default('#000000');
            $table->string('background_color')->default('#FFFFFF');
            $table->integer('background_type')->default('1'); //1.color 2.img 3.video
            $table->string('background_img')->nullable();
            $table->string('background_video')->nullable();            
            $table->string('background_if_herf')->nullable(); //0.n 1.y
            $table->string('background_herf')->nullable();
            $table->integer('text_align')->default('1'); //0.none 1.top 2.left 3.right
            //post 01           
            $table->integer('circle_count')->default('3'); 
            $table->string('s_img_1')->nullable();
            $table->string('s_img_2')->nullable();
            $table->string('s_img_3')->nullable();
            $table->string('s_img_title_1')->nullable();
            $table->string('s_img_title_2')->nullable();
            $table->string('s_img_title_3')->nullable(); 
            $table->string('circle_color')->default('#E3E3E3');
            //post 02 03
            $table->integer('m_media_type')->default('1'); //1.img 2.video 3.iframe            
            $table->string('m_media_title')->nullable();
            $table->string('m_img')->nullable();
            $table->longText('m_iframe')->nullable();
            $table->string('m_video')->nullable();
            $table->string('m_video_cover')->nullable();
            //btn
            $table->integer('btn_count')->default('2'); 
            $table->string('btn_text_color')->default('#000000');
            $table->string('btn_bg_color')->default('#FFFFFF');
            $table->string('btn_text_1')->nullable();
            $table->string('btn_text_2')->nullable();
            $table->string('btn_text_3')->nullable();
            $table->string('btn_text_4')->nullable();
            $table->string('btn_text_5')->nullable();
            $table->string('btn_text_6')->nullable();
            $table->longText('btn_herf_1')->nullable();
            $table->longText('btn_herf_2')->nullable();
            $table->longText('btn_herf_3')->nullable();
            $table->longText('btn_herf_4')->nullable();
            $table->longText('btn_herf_5')->nullable();
            $table->longText('btn_herf_6')->nullable();
            //post 04
            $table->string('card_background_img')->nullable();
            $table->integer('card_type')->default('0'); //1.條件產生 2.手動填入
            //條件產生
            $table->integer('product_typeid_1')->nullable();
            $table->integer('product_typeid_2')->nullable();
            $table->integer('product_range')->default('10'); 
            $table->string('product_orderby')->default('id'); 
            $table->integer('product_DESC_ASC')->default('1'); //1.DESC 2.ASC
            //手動填入
            $table->integer('product_id_01')->nullable();
            $table->integer('product_id_02')->nullable();
            $table->integer('product_id_03')->nullable();
            $table->integer('product_id_04')->nullable();
            $table->integer('product_id_05')->nullable();
            $table->integer('product_id_06')->nullable();
            $table->integer('product_id_07')->nullable();
            $table->integer('product_id_08')->nullable();
            $table->integer('product_id_09')->nullable();
            $table->integer('product_id_10')->nullable();
            
            $table->integer('status')->default('1'); //1.啟用 2.停用 3.刪除
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('create_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homeposts');
    }
};
