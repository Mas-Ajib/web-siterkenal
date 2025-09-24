<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ppid_requests', function (Blueprint $table) {
            $table->id();
            
            // Data Pemohon
            $table->string('nama_pemohon');
            $table->text('alamat');
            $table->string('nomor_handphone');
            $table->string('email');
            $table->text('informasi_dibutuhkan');
            $table->text('alasan_meminta');
            $table->string('cara_memperoleh');
            $table->string('cara_mengirim');
            
            // Status permohonan
            $table->string('status')->default('pending'); // pending, processed, completed, rejected
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ppid_requests');
    }
};