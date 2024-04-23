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
        Schema::create('ktps', function (Blueprint $table) {
            $table->id('NIK');
            $table->string('nama');
            $table->string('tempat');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['l', 'p']);
            $table->string('golongan_darah',2);
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('pekerjaan', 255);
            $table->string('status_keluarga',100);
            $table->string('status_anggota', 100);
            $table->binary('dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ktps');
    }
};
