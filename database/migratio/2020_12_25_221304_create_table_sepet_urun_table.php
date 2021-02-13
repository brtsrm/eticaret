<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSepetUrunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sepet_urun', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sepet_id");
            $table->unsignedBigInteger("urun_id");
            $table->integer("adet");
            $table->decimal("fiyati",5,2);
            $table->string("durum",30);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("sepet_id")->references("id")->on("sepet")->onDelete("cascade");
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
        Schema::dropIfExists('sepet_urun');
    }
}
