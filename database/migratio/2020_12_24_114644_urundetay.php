<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Urundetay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urun_detay', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("urun_id");
            $table->boolean("goster_slider")->default(0);
            $table->boolean("goster_gunun_firsati")->default(0);
            $table->boolean("goster_one_cikan")->default(0);
            $table->boolean("goster_cok_satan")->default(0);
            $table->boolean("goster_indirimli")->default(0);
            $table->foreign("urun_id")->references("id")->on("urun")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urun_detay');
    }
}