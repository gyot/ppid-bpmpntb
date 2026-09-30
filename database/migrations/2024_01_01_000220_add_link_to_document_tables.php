<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'information_publik',
            'documents',
            'daftar_informasi_publik',
            'sops',
            'regulasis',
            'keuangans',
            'lhkpns',
            'pengadaans',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    if (!Schema::hasColumn($table->getTable(), 'link')) {
                        $table->string('link')->nullable()->after('file_name');
                    }
                });
            }
        }
    }

    public function down(): void
    {
        $tables = [
            'information_publik',
            'documents',
            'daftar_informasi_publik',
            'sops',
            'regulasis',
            'keuangans',
            'lhkpns',
            'pengadaans',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    if (Schema::hasColumn($table->getTable(), 'link')) {
                        $table->dropColumn('link');
                    }
                });
            }
        }
    }
};