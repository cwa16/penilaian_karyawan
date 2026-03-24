<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performance_scale_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criteria_id');
            $table->integer('score');
            $table->text('description');
            $table->timestamps();

            $table->foreign('criteria_id')
                ->references('id')
                ->on('performance_criteria')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_scale_descriptions');
    }
};
