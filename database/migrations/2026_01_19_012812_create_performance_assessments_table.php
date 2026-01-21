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
    $table->foreignId('user_id')
          ->constrained('users')
          ->cascadeOnDelete();

    $table->foreignId('period_id')
          ->constrained('performance_periods')
          ->cascadeOnDelete();

    $table->timestamps();

    // 1 user 1 periode
    $table->unique(['user_id','period_id']);
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
