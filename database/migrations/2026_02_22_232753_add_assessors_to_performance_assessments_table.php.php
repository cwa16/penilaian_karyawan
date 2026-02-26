<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('performance_assessments', function (Blueprint $table) {

            // ID Penilai (User Login)
            $table->unsignedBigInteger('assessor1_id')->nullable()->after('user_nik');
            $table->unsignedBigInteger('assessor2_id')->nullable()->after('assessor1_id');

            // Status Penilaian
            $table->enum('status_assessor1', ['pending', 'completed'])
                  ->default('pending')
                  ->after('assessor2_id');

            $table->enum('status_assessor2', ['pending', 'completed'])
                  ->default('pending')
                  ->after('status_assessor1');

            // Foreign Key ke USERS
            $table->foreign('assessor1_id')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();

            $table->foreign('assessor2_id')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('performance_assessments', function (Blueprint $table) {

            $table->dropForeign(['assessor1_id']);
            $table->dropForeign(['assessor2_id']);

            $table->dropColumn([
                'assessor1_id',
                'assessor2_id',
                'status_assessor1',
                'status_assessor2',
            ]);
        });
    }
};