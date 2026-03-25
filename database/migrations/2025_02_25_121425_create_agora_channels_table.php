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
        Schema::create('agora_channels', function (Blueprint $table) {
            $table->id();
            $table->string('channel_name')->unique();
            $table->foreignId('from_user_id')->constrained('users');
            $table->string('to_user_id')->constrained('users');
            $table->text('token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agora_channels');
    }
};
