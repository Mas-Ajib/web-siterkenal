<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gratifikasi_reports', function (Blueprint $table) {
            $table->id();
            
            // Data Pribadi
            $table->string('nama_lengkap');
            $table->string('nik', 16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jabatan');
            $table->string('nama_instansi');
            $table->string('unit_kerja');
            $table->string('email');
            $table->string('no_seluler');
            $table->string('no_rumah')->nullable();
            $table->string('no_kantor')->nullable();
            $table->text('alamat_kantor');
            $table->text('alamat_pengiriman');
            
            // Data Penerimaan
            $table->text('jenis_penerimaan');
            $table->decimal('nilai_nominal', 15, 2);
            $table->text('peristiwa_penerimaan');
            $table->string('tempat_penerimaan');
            $table->date('tanggal_penerimaan');
            
            // Data Pemberi
            $table->string('nama_pemberi');
            $table->string('pekerjaan_jabatan_pemberi');
            $table->string('hubungan_dengan_pemberi');
            $table->text('alamat_pemberi');
            $table->string('telepon_pemberi')->nullable();
            $table->string('fax_pemberi')->nullable();
            $table->string('email_pemberi')->nullable();
            
            // Alasan dan Kronologi
            $table->text('alasan_pemberian');
            $table->text('kronologi_penerimaan');
            $table->string('link_dokumen')->nullable();
            $table->text('catatan_tambahan')->nullable();
            $table->boolean('bersedia_kompensasi')->default(false);
            $table->string('dokumen_path')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gratifikasi_reports');
    }
};