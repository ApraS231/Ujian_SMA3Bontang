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
        Schema::table('event_notes', function (Blueprint $table) {
            // Hapus foreign key dan kolom lama
            $table->dropForeign(['exam_session_id']);
            $table->dropColumn('exam_session_id');

            // Tambahkan kolom dan foreign key baru setelah kolom 'id'
            $table->foreignId('exam_id')->constrained()->onDelete('cascade')->after('id');
            $table->foreignId('room_id')->constrained()->onDelete('cascade')->after('exam_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_notes', function (Blueprint $table) {
            // Kembalikan kolom dan foreign key lama
            $table->foreignId('exam_session_id')->constrained()->onDelete('cascade');

            // Hapus kolom dan foreign key baru
            $table->dropForeign(['exam_id']);
            $table->dropForeign(['room_id']);
            $table->dropColumn(['exam_id', 'room_id']);
        });
    }
};
