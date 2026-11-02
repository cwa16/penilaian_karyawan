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
    Schema::create('kpi_kualitatifs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('period_id')->nullable();

        $table->string('nik')->nullable();
        $table->string('nama')->nullable();
        $table->string('status')->nullable();
        $table->string('dept')->nullable();
        $table->string('posisi')->nullable();

        $table->decimal('kpi_dept_full_year',8,2)->nullable();
        $table->decimal('kpi_dept_result',8,2)->nullable();

        $table->decimal('kpi_individu_full_year',8,2)->nullable();
        $table->decimal('kpi_individu_result',8,2)->nullable();

        $table->decimal('total_kpi',8,2)->nullable();

        $table->decimal('assessment_kpi',8,2)->nullable();
        $table->decimal('assessment_kpi_result',8,2)->nullable();

        $table->decimal('assessment_atasan',8,2)->nullable();
        $table->decimal('assessment_atasan_result',8,2)->nullable();

        $table->decimal('total_assessment',8,2)->nullable();

        $table->decimal('kehadiran',8,2)->nullable();
        $table->decimal('pengurang_kehadiran',8,2)->nullable();

        $table->decimal('late',8,2)->nullable();
        $table->decimal('pengurang_late',8,2)->nullable();

        $table->integer('st')->nullable();
        $table->integer('sp1')->nullable();
        $table->integer('sp2')->nullable();
        $table->integer('sp3')->nullable();

        $table->decimal('pengurang_score',8,2)->nullable();

        $table->decimal('assessment_final',8,2)->nullable();
        $table->string('grade')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_kualitatifs');
    }
};