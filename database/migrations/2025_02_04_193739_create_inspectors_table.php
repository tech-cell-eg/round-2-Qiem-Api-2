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
            Schema::create('inspectors', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade'); // علاقة مع جدول users
                $table->decimal('inspection_fee', 10, 2); // رسوم المعاينة
                $table->string('national_id'); // بطاقة الهوية الوطنية
                $table->string('certificate'); // شهادة الاعتماد
                $table->string('province')->nullable(); // المحافظة
                $table->string('area')->nullable();     // المنطقة
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspectors');
    }
};
