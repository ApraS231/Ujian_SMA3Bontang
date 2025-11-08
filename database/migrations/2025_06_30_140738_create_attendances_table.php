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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_session_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->integer('table_number'); // Nomor meja siswa di sesi tersebut
            $table->enum('status', ['hadir', 'tidak hadir', 'belum diisi'])->default('belum diisi');
            $table->timestamp('attended_at')->nullable(); // Waktu absen
            $table->timestamps();
            
            $table->unique(['exam_session_id', 'student_id']); // Siswa hanya bisa terdaftar sekali di satu sesi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
