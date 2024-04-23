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
        Schema::create('iurans', function (Blueprint $table) {
            $table->id('id_iuran');
            $table->decimal('nominal', 10, 2);
            $table->string('keterangan', 255);
            $table->string('jenis_transaksi', 255);
            $table->string('jenis_iuran');
            $table->unsignedBigInteger('no_kk')->index();
            $table->timestamps();

            $table->foreign('no_kk')->references('no_kk')->on('kks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iurans');
    }
};
