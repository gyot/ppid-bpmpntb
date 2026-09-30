<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'information_publik' => ['file_path', 'file_name', 'mime_type'],
            'documents' => ['file_path', 'file_name', 'mime_type'],
            'daftar_informasi_publik' => ['file_path', 'file_name'],
            'sops' => ['file_path', 'file_name'],
            'regulasis' => ['file_path', 'file_name'],
            'keuangans' => ['file_path', 'file_name'],
            'lhkpns' => ['file_path', 'file_name'],
            'pengadaans' => ['file_path', 'file_name'],
        ];

        foreach ($tables as $table => $columns) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) use ($columns) {
                    foreach ($columns as $col) {
                        if (Schema::hasColumn($table->getTable(), $col)) {
                            $table->string($col)->nullable()->change();
                        }
                    }
                });
            }
        }
    }

    public function down(): void
    {
        // Irreversible - would require data cleanup
    }
};
