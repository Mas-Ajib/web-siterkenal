<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kritik_saran_reports', function (Blueprint $table) {
            $table->id();
            
            // Data Pengirim
            $table->string('nama')->nullable();
            $table->string('telepon')->nullable();
            $table->text('kritik')->nullable();
            $table->text('saran')->nullable();
            $table->text('pengaduan_layanan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kritik_saran_reports');
    }
};