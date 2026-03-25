<?php

use App\Enum\TaskQuestionEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('axis_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->foreignId('axis_id')->constrained('axes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('answer_type', TaskQuestionEnum::values())->comment('essay multiple true or false');
            $table->enum('require_file', ['0', '1'])->default(0)->comment('0=> not require, 1=> require');
            $table->foreignId('true_parent_id')->nullable()->constrained('axis_questions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('false_parent_id')->nullable()->constrained('axis_questions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('order_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('axis_questions');
    }
};
