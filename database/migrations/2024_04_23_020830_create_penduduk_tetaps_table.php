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
        Schema::create('penduduk_tetaps', function (Blueprint $table) {
            $table->id('id_penduduk_tetap');
            $table->string('nama', 255);
            $table->unsignedBigInteger('no_rumah')->index();
            $table->unsignedBigInteger('no_kk')->index();
            $table->unsignedBigInteger('NIK')->index();
            $table->timestamps();

            $table->foreign('no_rumah')->references('no_rumah')->on('rumahs');
            $table->foreign('no_kk')->references('no_kk')->on('kks');
            $table->foreign('NIK')->references('NIK')->on('ktps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk_tetaps');
    }
};
