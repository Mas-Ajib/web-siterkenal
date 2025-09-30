<?php
// database/migrations/2024_01_01_create_visitors_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45); // Support IPv6
            $table->string('user_agent')->nullable();
            $table->string('browser')->nullable();
            $table->string('platform')->nullable();
            $table->string('device')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('referrer')->nullable(); // Sumber traffic
            $table->string('page_visited'); // Halaman yang dikunjungi
            $table->date('visit_date');
            $table->time('visit_time');
            $table->integer('session_duration')->default(0); // dalam detik
            $table->timestamps();
            
            // Index untuk performa query
            $table->index('visit_date');
            $table->index('ip_address');
            $table->index(['visit_date', 'page_visited']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitors');
    }
};