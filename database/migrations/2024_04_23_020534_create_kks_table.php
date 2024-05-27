<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kks', function (Blueprint $table) {
            $table->id('no_kk');
            $table->string('nama_kepala_keluarga');
            $table->unsignedBigInteger('no_rumah')->index();
            $table->integer('jumlah_individu');
            $table->string('alamat', 255);
            $table->string('paguyuban', 255)->nullable();
            $table->string('dokumen',255)->nullable();
            $table->timestamps();

            $table->foreign('no_rumah')->references('no_rumah')->on('rumahs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kks');
    }
};
