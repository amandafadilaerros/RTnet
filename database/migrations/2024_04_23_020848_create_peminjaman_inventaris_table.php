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
        Schema::create('peminjaman_inventaris', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->unsignedBigInteger('id_inventaris')->index();
            $table->unsignedBigInteger('id_peminjam')->index();
            $table->date('tanggal_peminjaman');
            $table->int('jumlah_peminjaman');
            $table->date('tanggal_kembali');
            $table->timestamps();

            $table->foreign('id_inventaris')->references('id_inventaris')->on('inventaris');
            $table->foreign('id_peminjam')->references('NIK')->on('ktps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_inventaris');
    }
};
