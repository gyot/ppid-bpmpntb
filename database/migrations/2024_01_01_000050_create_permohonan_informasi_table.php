<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permohonan_informasi', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('nama');
            $table->string('nik', 16);
            $table->string('email');
            $table->string('phone');
            $table->text('alamat');
            $table->text('informasi_diminta');
            $table->text('tujuan_permohonan');
            $table->enum('cara_memperoleh', ['email', 'pos', 'langsung'])->default('email');
            $table->enum('cara_mendapatkan', ['elektronik', 'non_elektronik'])->default('elektronik');
            $table->string('identity_file_path')->nullable();
            $table->string('identity_file_name')->nullable();
            $table->enum('status', ['submitted', 'verified', 'processing', 'completed', 'rejected'])->default('submitted');
            $table->text('notes')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permohonan_informasi');
    }
};
