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
        Schema::create('tats', function (Blueprint $table) {
            $table->id();
            $table->string('instansi_pemohon');
            $table->string('nama_tersangka');
            $table->date('tanggal_penangkapan');
            $table->string('jenis_barang_bukti');
            $table->string('berat_barang_bukti');
            $table->string('hasil_urine');
            $table->string('surat_permohonan'); // path file PDF
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tats');
    }
};
