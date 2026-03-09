<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKpiKualitatifsTable extends Migration
{
    public function up()
    {
        Schema::table('kpi_kualitatifs', function (Blueprint $table) {

            if (!Schema::hasColumn('kpi_kualitatifs', 'no')) {
                $table->integer('no')->nullable()->after('id');
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'status')) {
                $table->string('status')->nullable()->after('nama');
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'kpi_dept_full_year')) {
                $table->decimal('kpi_dept_full_year',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'kpi_dept_result')) {
                $table->decimal('kpi_dept_result',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'kpi_individu_full_year')) {
                $table->decimal('kpi_individu_full_year',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'kpi_individu_result')) {
                $table->decimal('kpi_individu_result',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'total')) {
                $table->decimal('total',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'assessment_kpi_60')) {
                $table->decimal('assessment_kpi_60',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'assessment_atasan_40')) {
                $table->decimal('assessment_atasan_40',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'assessment_atasan_result')) {
                $table->decimal('assessment_atasan_result',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'total_assessment')) {
                $table->decimal('total_assessment',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'percent_kehadiran')) {
                $table->decimal('percent_kehadiran',5,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'pengurang_kehadiran')) {
                $table->decimal('pengurang_kehadiran',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'percent_late')) {
                $table->decimal('percent_late',5,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'pengurang_late')) {
                $table->decimal('pengurang_late',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'st')) {
                $table->integer('st')->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'sp1')) {
                $table->integer('sp1')->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'sp2')) {
                $table->integer('sp2')->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'sp3')) {
                $table->integer('sp3')->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'pengurang_sp')) {
                $table->decimal('pengurang_sp',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'assessment_final')) {
                $table->decimal('assessment_final',10,2)->nullable();
            }

            if (!Schema::hasColumn('kpi_kualitatifs', 'grade')) {
                $table->string('grade')->nullable();
            }

        });
    }

    public function down()
    {
        //
    }
}