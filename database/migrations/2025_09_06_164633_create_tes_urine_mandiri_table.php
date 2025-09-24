<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tes_urine_mandiri', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_tes'); // Masyarakat / Pemerintah / Swasta / Pendidikan
            $table->string('nama_penyelenggara');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('tempat');
            $table->string('nama_penanggung_jawab');
            $table->string('nohp_penanggung_jawab');
            $table->integer('jumlah_peserta');
            $table->text('keterangan')->nullable();
            $table->string('lampiran')->nullable(); // file upload
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tes_urine_mandiri');
    }
};
