<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'admin_ppid', 'petugas', 'pemohon'])->default('pemohon')->after('email');
            $table->string('phone')->nullable()->after('role');
            $table->string('nik', 16)->nullable()->after('phone');
            $table->text('address')->nullable()->after('nik');
            $table->string('avatar')->nullable()->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'nik', 'address', 'avatar']);
        });
    }
};
