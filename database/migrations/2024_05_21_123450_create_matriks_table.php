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
        Schema::create('matriks', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kriteria');
            $table->unsignedBigInteger('id_alternatif');
            $table->int('nilai');
            $table->timestamps();

            $table->foreign('id_kriteria')->references('id_kriteria')->on('kriterias')->onDelete('cascade');
            $table->foreign('id_alternatif')->references('id_alternatif')->on('alternatifs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriks');
    }
};
