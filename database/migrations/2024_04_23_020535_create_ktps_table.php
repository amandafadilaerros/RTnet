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
            $table->unsignedBigInteger('no_kk')->index();
            $table->string('nama');
            $table->string('tempat');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['l', 'p']);
            $table->string('golongan_darah',2);
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('pekerjaan', 255);
            $table->string('status_keluarga',100)->nullable();
            $table->string('status_anggota', 100)->nullable();
            $table->string('jenis_penduduk', 100)->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->string('dokumen',255)->nullable();
            $table->timestamps();
            $table->foreign('no_kk')->references('no_kk')->on('kks');
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
