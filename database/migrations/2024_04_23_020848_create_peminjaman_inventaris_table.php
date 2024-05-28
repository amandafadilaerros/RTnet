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
            $table->unsignedBigInteger('id_peminjam')->index()->nullable();
            $table->date('tanggal_peminjaman')->nullable();
            $table->integer('jumlah_peminjaman')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->timestamps();

            $table->foreign('id_inventaris')->references('id_inventaris')->on('inventaris');
            $table->foreign('id_peminjam')->references('no_kk')->on('kks');
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
