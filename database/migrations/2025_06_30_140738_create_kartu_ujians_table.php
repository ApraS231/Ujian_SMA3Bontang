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
        Schema::create('kartu_ujians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesi_ujian_id')->constrained('sesi_ujians')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->integer('table_number'); // Nomor meja siswa di sesi tersebut
            $table->enum('attendance_status', ['hadir', 'tidak hadir', 'belum diisi'])->default('belum diisi');
            $table->timestamps();
            
            $table->unique(['sesi_ujian_id', 'siswa_id']); // Siswa hanya bisa terdaftar sekali di satu sesi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_ujians');
    }
};
