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
        Schema::create('daily_assign_user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_report_assign_user_id')->constrained('daily_report_assign_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('axis_question_id')->constrained('axis_questions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('answer')->nullable();
            $table->foreignId('question_answer_id')->nullable()->constrained('question_answers')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['0', '1', '2'])->comment('0 =pending 1= accepted 2= rejected');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('refuse_reason')->nullable();
            $table->string('refuse_notice')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_assign_user_answers');
    }
};
