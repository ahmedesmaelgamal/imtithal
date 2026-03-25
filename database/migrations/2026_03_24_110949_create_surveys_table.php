<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\TaskQuestionEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            // $table->enum('answer_type', TaskQuestionEnum::values())->comment('essay multiple true or false');
            // $table->enum('require_file', ['0', '1'])->default(0)->comment('0=> not require, 1=> require');
            // // $table->foreignId('true_parent_id')->nullable();
            // // $table->foreignId('false_parent_id')->nullable();
            // $table->bigInteger('order_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
