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
    Schema::create('kpi_scores', function (Blueprint $table) {
        $table->id();
        $table->year('tahun');
        $table->string('nik');
        $table->string('nama');
        $table->string('dept')->nullable();
        $table->string('jabatan')->nullable();
        $table->string('posisi')->nullable();
        $table->decimal('total_kpi', 5, 2)->default(0); // contoh: 85.50
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_scores');
    }
};
