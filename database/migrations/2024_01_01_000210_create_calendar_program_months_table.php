<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_program_months', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calendar_program_id')->constrained('calendar_programs')->cascadeOnDelete();
            $table->integer('bulan');
            $table->timestamps();
            
            $table->unique(['calendar_program_id', 'bulan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_program_months');
    }
};
