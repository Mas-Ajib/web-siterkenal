<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan_gratifikasi', function (Blueprint $table) {
            $table->id();
            // Data Pelapor
            $table->string('nama');
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('instansi')->nullable();
            $table->string('unit_eselon')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_rumah')->nullable();
            $table->string('no_kantor')->nullable();
            $table->text('alamat_kantor')->nullable();
            $table->text('alamat_pengiriman')->nullable();
            $table->text('uraian')->nullable();
            $table->string('nilai')->nullable();
            $table->text('peristiwa')->nullable();
            $table->string('tempat_tgl')->nullable();

            // Data Pemberi
            $table->string('nama_pemberi')->nullable();
            $table->string('pekerjaan_pemberi')->nullable();
            $table->string('hubungan_pemberi')->nullable();
            $table->text('kontak_pemberi')->nullable();

            // Alasan & Kronologi
            $table->text('alasan')->nullable();
            $table->text('kronologi')->nullable();
            $table->string('link_dokumen')->nullable();
            $table->text('catatan')->nullable();
            $table->boolean('kompensasi')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan_gratifikasi');
    }
};
