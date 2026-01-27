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
        Schema::create('performance_scores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assessment_id')
                ->constrained('performance_assessments')
                ->cascadeOnDelete();

            $table->foreignId('criteria_id')
                ->constrained('performance_criteria')
                ->cascadeOnDelete();

            // NIK penilai
            $table->string('evaluator_nik');

            $table->decimal('score', 3, 2); // 1.00 – 5.00
            $table->timestamps();

            // FK ke users.nik
            $table->foreign('evaluator_nik')
                ->references('nik')
                ->on('users')
                ->cascadeOnDelete();

            $table->unique(
                ['assessment_id', 'criteria_id', 'evaluator_nik'],
                'uq_ps_assess_crit_eval'
            );

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_scores');
    }
};
