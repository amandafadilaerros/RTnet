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
            $table->unsignedBigInteger('id_level')->index();
            $table->integer('jumlah_individu');
            $table->string('alamat', 255);
            $table->binary('dokumen')->nullable();
            $table->timestamps();

            $table->foreign('id_level')->references('id_level')->on('levels');
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
