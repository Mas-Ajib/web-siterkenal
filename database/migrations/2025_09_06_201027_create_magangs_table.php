<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('magangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('instansi');
            $table->string('penanggung_jawab');
            $table->string('kontak');
            $table->string('jangka_waktu');
            $table->integer('jumlah_peserta');
            $table->string('lampiran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('magangs');
    }
};
