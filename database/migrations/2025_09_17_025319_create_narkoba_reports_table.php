<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('narkoba_reports', function (Blueprint $table) {
            $table->id();
            
            // Data Pelapor
            $table->string('nama')->nullable();
            $table->string('telepon')->nullable();
            $table->text('tempat_kejadian');
            $table->text('keterangan');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('narkoba_reports');
    }
};