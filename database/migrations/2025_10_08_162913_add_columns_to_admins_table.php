<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_columns_to_admins_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('role');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'last_login_at']);
        });
    }
};