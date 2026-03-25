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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('trip_number')->nullable();
            $table->string('air_carrier')->nullable();
            $table->string('departure_country')->nullable();
            $table->string('readiness_list_number')->nullable();
            $table->string('service_provider')->nullable();
            $table->integer('hajj_groups_count')->default(0);
            $table->integer('hajjis_count')->default(0);
            $table->unsignedBigInteger('accommodation_id')->nullable();
            $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('cascade');
            $table->date('arrival_date')->nullable();
            $table->time('arrival_time')->nullable();
            $table->string('executor')->nullable();
            $table->string('contract_number')->nullable();
            $table->string('residence_city')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
