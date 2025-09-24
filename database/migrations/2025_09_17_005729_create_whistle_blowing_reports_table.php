<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('whistle_blowing_reports', function (Blueprint $table) {
            $table->id();
            
            // Data Pelapor
            $table->string('jenis_pelanggaran');
            $table->string('jenis_pelanggaran_lainnya')->nullable();
            $table->string('nama_pelapor')->nullable();
            $table->string('lokasi_kejadian');
            $table->string('kota_kabupaten');
            $table->string('provinsi');
            $table->date('tanggal_kejadian');
            $table->time('waktu_kejadian')->nullable();
            $table->text('uraian_pengaduan');
            $table->string('email')->nullable();
            $table->boolean('pernyataan')->default(false);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('whistle_blowing_reports');
    }
};