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
        Schema::create('penduduk_kos', function (Blueprint $table) {
            $table->id('id_penduduk_kos');
            $table->string('nama', 255);
            $table->unsignedBigInteger('NIK')->index();
            $table->timestamps();

            $table->foreign('NIK')->references('NIK')->on('ktps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk_kos');
    }
};
