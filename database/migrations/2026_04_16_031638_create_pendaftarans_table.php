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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->references('id')->on('pasien')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('poli_id')->references('id')->on('poli')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('dokter_id')->references('id')->on('dokter')->cascadeOnUpdate()->cascadeOnDelete();
            $table->datetime('tanggal_daftar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
