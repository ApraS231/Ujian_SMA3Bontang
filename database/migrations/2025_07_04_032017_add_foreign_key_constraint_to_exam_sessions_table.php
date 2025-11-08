<?php

// File: database/migrations/xxxx_xx_xx_xxxxxx_add_foreign_key_constraint_to_exam_sessions_table.php
namespace Illuminate\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('exam_sessions', function (Blueprint $table) {
            // Hapus foreign key lama jika ada (untuk keamanan)
            // Laravel biasanya menamainya 'namatabel_kolom_foreign'
            $table->dropForeign('exam_sessions_exam_id_foreign');

            // Tambahkan foreign key baru dengan onDelete('cascade')
            $table->foreign('exam_id')
                  ->references('id')
                  ->on('exams')
                  ->onDelete('cascade'); // Ini adalah kuncinya
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_sessions', function (Blueprint $table) {
            // Jika migrasi di-rollback, kembalikan foreign key tanpa cascade
            $table->dropForeign(['exam_id']);
            $table->foreign('exam_id')->references('id')->on('exams');
        });
    }
};
