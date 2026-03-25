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
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->enum('type', ['alert', 'notification', 'reminder']);
            $table->foreignId('leader_id')->nullable()->constrained('users');
            $table->foreignId('admin_id')->nullable()->constrained('admins');
            $table->enum('to', ['0', '1', '2'])->nullable()->comment('
            0 = من المشرف الي الادراة
            | 1 =من المشرف الي  الموظفين
             |2= من الاداره الي المشرفين
             ');
            $table->enum('priority', ['low', 'mid', 'high'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
