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
        Schema::table('areas', function (Blueprint $table) {
            $table->enum('type',\App\Enum\AreaTypeEnum::values())->nullable()->comment('
                                موقف =0
                             - باص =1
                             -سكة حديدية=2
                             -طريق=3
                            -  محطة=4

                            ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
