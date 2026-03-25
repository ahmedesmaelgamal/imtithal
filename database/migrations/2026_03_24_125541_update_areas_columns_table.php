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
        // 1. Drop foreign key in trips first if it exists
        if (Schema::hasColumn('trips', 'accommodation_id')) {
            Schema::table('trips', function (Blueprint $table) {
                // Drop foreign key if it exists
                // Note: Standard Laravel foreign key name for accommodation_id on trips is trips_accommodation_id_foreign
                $table->dropForeign(['accommodation_id']);
            });
        }

        // 2. Drop accommodations table
        Schema::dropIfExists('accommodations');

        // 3. Update areas table
        Schema::table('areas', function (Blueprint $table) {
            // Drop old axis_id and its foreign key
            if (Schema::hasColumn('areas', 'axis_id')) {
                try {
                    $table->dropForeign(['axis_id']);
                } catch (\Exception $e) {}
                $table->dropColumn('axis_id');
            }

            // Add new columns from accommodations with checks
            if (!Schema::hasColumn('areas', 'type')) {
                $table->string('type')->nullable()->after('name'); // 'main', 'sub'
            } else {
                $table->string('type')->nullable()->change();
            }

            if (!Schema::hasColumn('areas', 'parent_id')) {
                $table->unsignedBigInteger('parent_id')->nullable()->after('type');
                $table->foreign('parent_id')->references('id')->on('areas')->onDelete('cascade');
            }

            if (!Schema::hasColumn('areas', 'season_id')) {
                $table->unsignedBigInteger('season_id')->nullable()->after('parent_id')->default(1);
                $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            }

            if (!Schema::hasColumn('areas', 'location')) {
                $table->string('location')->nullable()->after('season_id');
            }
            if (!Schema::hasColumn('areas', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->after('location');
            }
            if (!Schema::hasColumn('areas', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            }
            if (!Schema::hasColumn('areas', 'status')) {
                $table->boolean('status')->default(1)->after('longitude');
            }
        });

        // 4. Update trips table to use area_id
        Schema::table('trips', function (Blueprint $table) {
            if (Schema::hasColumn('trips', 'accommodation_id')) {
                if (!Schema::hasColumn('trips', 'area_id')) {
                    $table->renameColumn('accommodation_id', 'area_id');
                } else {
                    $table->dropColumn('accommodation_id');
                }
            } else if (!Schema::hasColumn('trips', 'area_id')) {
                $table->unsignedBigInteger('area_id')->nullable();
            }

            // Refresh for FK
        });

        Schema::table('trips', function (Blueprint $table) {
            if (Schema::hasColumn('trips', 'area_id')) {
                try {
                    $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
                } catch (\Exception $e) {}
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Handled via git reset in this specific workflow since it's a major refactor
    }
};
