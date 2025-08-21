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
        Schema::create('companyinfos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_id')->nullable();
            $table->string('name_full')->nullable();
            $table->string('name_short')->nullable();
            $table->string('name_eng')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('tel_num_1')->nullable();
            $table->string('tel_num_2')->nullable();
            $table->string('email')->nullable();
            $table->longText('content')->nullable();
            $table->longText('note')->nullable();
            $table->string('logo_img_1')->nullable();
            $table->string('logo_img_2')->nullable();
            $table->string('other_herf_1')->nullable();
            $table->string('other_herf_2')->nullable();
            $table->string('other_herf_3')->nullable();
            $table->string('other_herf_4')->nullable();
            $table->string('other_herf_5')->nullable();
            $table->integer('status')->default('1'); //1.啟用 2.刪除
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
        Schema::dropIfExists('companyinfos');
    }
};
