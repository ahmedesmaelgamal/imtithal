<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('event'); // اسم الحدث مثل "create", "update", "delete"
            $table->string('model_type'); // نوع الموديل مثل "App\Models\Post"
            $table->unsignedBigInteger('model_id'); // ID الخاص بالموديل
            $table->text('description')->nullable(); // وصف الإجراء
            $table->json('old_data')->nullable(); // البيانات القديمة قبل التغيير
            $table->json('new_data')->nullable(); // البيانات الجديدة بعد التغيير
            $table->ipAddress('ip_address')->nullable(); // عنوان الـ IP الخاص بالمستخدم
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
