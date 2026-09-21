<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daftar_informasi_publik', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('category', ['berkala', 'setiap_saat', 'serta_merta', 'dikecualikan']);
            $table->string('jenis_informasi');
            $table->text('uraian_informasi')->nullable();
            $table->string('sumber_informasi')->nullable();
            $table->string('media_informasi')->nullable();
            $table->string('jkd')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daftar_informasi_publik');
    }
};
