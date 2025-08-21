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

            $table->double('retail_price')->default(0)->after('type_id');        //零售價
            $table->double('factory_price')->default(0)->after('retail_price');  //出廠價
            $table->double('special_price')->default(0)->after('factory_price'); //特價
            $table->double('discount')->default(0)->after('special_price');      //折扣率
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

            $table->dropColumn('retail_price');
            $table->dropColumn('factory_price');
            $table->dropColumn('special_price');
            $table->dropColumn('discount');
        });
    }
};
