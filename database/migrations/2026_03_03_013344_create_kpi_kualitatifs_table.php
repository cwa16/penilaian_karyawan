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
        if (!Schema::hasTable('kpi_kualitatifs')) {
            Schema::create('kpi_kualitatifs', function (Blueprint $table) {
                $table->id();
                $table->year('tahun');
                $table->string('nik');
                $table->string('nama');
                $table->string('dept')->nullable();
                $table->string('jabatan')->nullable();
                $table->string('posisi')->nullable();
                $table->string('kategori'); // contoh: Leadership, Disiplin, Teamwork
                $table->decimal('nilai', 5, 2)->default(0); // nilai per kategori
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_kualitatifs');
    }
};