<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keberatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->nullable()->constrained('permohonan_informasi')->nullOnDelete();
            $table->string('registration_number')->unique();
            $table->string('nama');
            $table->string('nik');
            $table->string('email');
            $table->string('phone');
            $table->text('alamat');
            $table->text('alasan_keberatan');
            $table->text('informasi_terkait');
            $table->enum('status', ['submitted', 'reviewing', 'responded', 'resolved'])->default('submitted');
            $table->text('response')->nullable();
            $table->foreignId('responded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keberatan');
    }
};
