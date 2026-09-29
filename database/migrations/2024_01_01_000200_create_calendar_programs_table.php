<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_programs', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->string('penanggung_jawab', 100);
            $table->string('uraian_kegiatan');
            $table->text('deskripsi')->nullable();
            $table->decimal('anggaran', 15, 2)->nullable();
            $table->integer('urutan')->default(0);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('tahun');
            $table->index('status');
            $table->index('penanggung_jawab');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_programs');
    }
};
