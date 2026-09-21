<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->string('penanggung_jawab')->nullable();
            $table->string('target')->nullable();
            $table->string('jadwal')->nullable();
            $table->string('sumber_anggaran')->nullable();
            $table->decimal('besaran_anggaran', 15, 2)->nullable();
            $table->integer('tahun');
            $table->enum('jenis', ['program', 'kegiatan', 'strategis']);
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
