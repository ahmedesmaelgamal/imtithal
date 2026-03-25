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
        Schema::create('daily_report_assign_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_report_id')->constrained('daily_reports')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('deadline');
            $table->enum('status', ['0', '1', '2', '3', '4'])->comment('
              1 = تم البدء
             2=تحت المراجعه
             4= منتهه,
             3= تحتاج للتعديل,
           0=لم يتم البدء'
            );
            $table->foreignId('axis_id')->constrained('axes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('area_id')->constrained('areas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('leader_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_report_assign_users');
    }
};
