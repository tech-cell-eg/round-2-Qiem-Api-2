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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->references('company_id')->on('companies')->cascadeOnDelete();
            $table->foreignId('offer_id')->references('id')->on('offers')->cascadeOnDelete();
            $table->enum('status',['active','ended'])->default('active');
            $table->string('description');
            $table->text('comment');
            $table->string('resume_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
