<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. daily_reports: drop axis_id, add survey_id
        Schema::table('daily_reports', function (Blueprint $table) {
            if (Schema::hasColumn('daily_reports', 'axis_id')) {
                $table->dropForeign(['axis_id']);
                $table->dropColumn('axis_id');
            }
        });
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->foreignId('survey_id')->nullable()->after('description')->constrained('surveys')->cascadeOnDelete()->cascadeOnUpdate();
        });

        // 2. daily_report_assign_users: drop axis_id
        Schema::table('daily_report_assign_users', function (Blueprint $table) {
            if (Schema::hasColumn('daily_report_assign_users', 'axis_id')) {
                $table->dropForeign(['axis_id']);
                $table->dropColumn('axis_id');
            }
        });

        // 3. daily_assign_user_answers: rename axis_question_id -> survey_question_id
        Schema::table('daily_assign_user_answers', function (Blueprint $table) {
            if (Schema::hasColumn('daily_assign_user_answers', 'axis_question_id')) {
                $table->dropForeign(['axis_question_id']);
                $table->renameColumn('axis_question_id', 'survey_question_id');
            }
        });
        Schema::table('daily_assign_user_answers', function (Blueprint $table) {
            $table->foreign('survey_question_id')->references('id')->on('servay_questions')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse survey_question_id back to axis_question_id
        Schema::table('daily_assign_user_answers', function (Blueprint $table) {
            $table->dropForeign(['survey_question_id']);
            $table->renameColumn('survey_question_id', 'axis_question_id');
        });
        Schema::table('daily_assign_user_answers', function (Blueprint $table) {
            $table->foreign('axis_question_id')->references('id')->on('axis_questions')->cascadeOnDelete()->cascadeOnUpdate();
        });

        // Reverse daily_report_assign_users
        Schema::table('daily_report_assign_users', function (Blueprint $table) {
            $table->foreignId('axis_id')->nullable()->constrained('axes')->cascadeOnUpdate()->cascadeOnDelete();
        });

        // Reverse daily_reports
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->dropForeign(['survey_id']);
            $table->dropColumn('survey_id');
        });
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->foreignId('axis_id')->nullable()->constrained('axes')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
};
