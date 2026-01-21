<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('performance_assessments', function (Blueprint $table) {
            $table->id();

            // NIK karyawan yang dinilai
            $table->string('user_nik');

            $table->foreignId('period_id')
                ->constrained('performance_periods')
                ->cascadeOnDelete();

            $table->enum('status', ['draft', 'submitted', 'approved'])
                ->default('draft');

            $table->timestamps();

            // Relasi ke users.nik
            $table->foreign('user_nik')
                ->references('nik')
                ->on('users')
                ->cascadeOnDelete();

            // Cegah penilaian ganda
            $table->unique(['user_nik', 'period_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_assessments');
    }
};
