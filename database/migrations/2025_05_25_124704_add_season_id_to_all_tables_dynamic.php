<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $tables = DB::select('SHOW TABLES');
        $dbName = DB::getDatabaseName();
        $tableKey = 'Tables_in_' . $dbName;

        foreach ($tables as $table) {
            $tableName = $table->$tableKey;

            if (in_array($tableName, ['migrations', 'seasons', 'failed_jobs', 'password_resets', 'personal_access_tokens','cache_locks','cache','model_has_permissions','model_has_roles', 'role_has_permissions','password_reset_tokens'])) continue;

            if (Schema::hasTable($tableName) && !Schema::hasColumn($tableName, 'season_id')) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    $table->unsignedBigInteger('season_id')->nullable()->after('id')->default(1);

                });

                echo "Added 'season_id' to {$tableName}\n";
            }
        }
    }

    public function down(): void
    {
        $tables = DB::select('SHOW TABLES');
        $dbName = DB::getDatabaseName();
        $tableKey = 'Tables_in_' . $dbName;

        foreach ($tables as $table) {
            $tableName = $table->$tableKey;

            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'season_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('season_id');
                });

                echo "Dropped 'season_id' from {$tableName}\n";
            }
        }
    }
};
