<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lhkpns', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pejabat');
            $table->string('jabatan');
            $table->string('nip')->nullable();
            $table->year('periode');
            $table->string('file_path');
            $table->string('file_name');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lhkpns');
    }
};
