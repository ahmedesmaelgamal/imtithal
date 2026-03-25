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
        Schema::create('violation_reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('reference_number')->nullable()->unique();
            $table->string('violation_time');
            $table->string('violation_date');
            $table->string('map_url');
            $table->string('lat');
            $table->string('long');
            $table->string('plate_number');
            $table->string('plate_letter_ar');
            $table->string('plate_letter_en');
            $table->string('plate_image')->nullable();
            $table->string('vehicle_type');// must be enum
            $table->string('violation_image')->nullable();
            $table->string('violation_video')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('admin_id')->nullable()->constrained('admins')->cascadeOnDelete()->cascadeOnUpdate();

            $table->enum('user_type', ['0', '1'])->comment('0 => leader, 1 => user');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violation_reports');
    }
};
