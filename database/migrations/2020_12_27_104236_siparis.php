<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Siparis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
        Schema::create('siparis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sepet_id')->unique();
            $table->decimal('siparis_tutari',5,4);
            $table->string('durum',30)->nullable(); 
            $table->string('adsoyad',50)->nullable();
            $table->string('adres',2000)->nullable();
            $table->string('telefon',15)->nullable();
            $table->string('ceptelefon',15)->nullable();
            $table->string('banka',20)->nullable();
            $table->integer('taksit_sayisi')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sepet_id')->references('id')->on('sepet')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siparis');
    }
}
