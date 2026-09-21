<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengadaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->decimal('nilai_pagu', 15, 2)->nullable();
            $table->integer('tahun');
            $table->enum('tahap', ['rencana', 'pemilihan', 'pelaksanaan']);
            $table->string('penyedia')->nullable();
            $table->string('no_kontrak')->nullable();
            $table->date('tanggal_kontrak')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengadaans');
    }
};
