<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('regulasis', function (Blueprint $table) {
            $table->string('kategori')->default('lainnya')->change();
        });
    }

    public function down(): void
    {
        Schema::table('regulasis', function (Blueprint $table) {
            $table->enum('kategori', ['uu', 'pp', 'perma', 'perki', 'permendikbud', 'lainnya'])->change();
        });
    }
};
