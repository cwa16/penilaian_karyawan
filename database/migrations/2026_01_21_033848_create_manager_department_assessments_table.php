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
        Schema::create('manager_department_assessments', function (Blueprint $table) {
            $table->id();

            // Manager (penilai)
            $table->string('manager_nik');

            // Departemen yang boleh dinilai
            $table->string('department_code');

            $table->timestamps();

            $table->foreign('manager_nik')
                ->references('nik')
                ->on('users')
                ->cascadeOnDelete();

            $table->unique(
                ['manager_nik', 'department_code'],
                'uq_mgr_dept_assessment'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_department_assessments');
    }
};
