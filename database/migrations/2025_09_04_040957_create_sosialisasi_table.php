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
        Schema::create('sosialisasi', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_sosialisasi');
            $table->string('nama_penyelenggara');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('tempat');
            $table->string('nama_penanggung_jawab');
            $table->string('no_hp_penanggung_jawab');
            $table->integer('jumlah_peserta');
            $table->text('keterangan')->nullable();
            $table->string('lampiran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sosialisasi');
    }
};
