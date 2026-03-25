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
        Schema::create('support_chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_chat_id')->constrained('support_chats')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('from_user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('to_user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('message')->nullable();
            $table->string('voice')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_chat_messages');
    }
};
