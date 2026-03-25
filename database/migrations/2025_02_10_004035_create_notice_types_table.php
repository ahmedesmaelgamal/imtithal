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
        Schema::create('notice_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('priority', ['suggest', 'low', 'mid', 'high']);
            $table->enum('period', ['none', 'after 24 hours', 'after 48 hours', 'live']);
            $table->enum('level', ['لم يتم التصعيد', 'اذا لم يعالج', 'تصعيد مباشر']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notice_types');
    }
};
