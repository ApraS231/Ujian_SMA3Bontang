<?php

use Illuminate.Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update kartu_ujians table
        Schema::table('kartu_ujians', function (Blueprint $table) {
            $table->dropForeign(['exam_id']);
            $table->dropColumn('exam_id');
            $table->foreignId('exam_session_id')->constrained('exam_sessions')->onDelete('cascade')->after('id');
        });

        // Update event_notes table
        Schema::table('event_notes', function (Blueprint $table) {
            $table->dropForeign(['exam_id']);
            $table->dropColumn('exam_id');
            $table->foreignId('exam_session_id')->constrained('exam_sessions')->onDelete('cascade')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert kartu_ujians table
        Schema::table('kartu_ujians', function (Blueprint $table) {
            $table->dropForeign(['exam_session_id']);
            $table->dropColumn('exam_session_id');
            $table->foreignId('exam_id')->constrained('subjects')->onDelete('cascade'); // old table was exams, now subjects
        });

        // Revert event_notes table
        Schema::table('event_notes', function (Blueprint $table) {
            $table->dropForeign(['exam_session_id']);
            $table->dropColumn('exam_session_id');
            $table->foreignId('exam_id')->constrained('subjects')->onDelete('cascade');
        });
    }
};
