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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->foreignId('notice_type_id')->nullable()->constrained('notice_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('suggestion_title')->nullable()
                ->comment('this is title id notice user can send notice_type_id or title as text if in suggestion');
            $table->string('lat');
            $table->string('long');
            $table->string('notice_time');
            $table->string('notice_date');
            $table->foreignId('user_id')->nullable( )->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['0', '1', '2', '3'])->comment('0 = تحت المراجعه 1=مقبول 2= مرفوض 3= تم تصعيدها للمدير النظام');
            $table->boolean('is_up')->default(0)->comment('التصعيد'); // التصعيد
            $table->string('refuse_reason')->nullable();
            $table->string('refuse_notice')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('leader_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
