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
        Schema::create('evaluation_reports', function (Blueprint $table) {
            $table->foreignId('inspector_common_reports')->references('id')->on('inspector_reports')->cascadeOnDelete();
            $table->primary('inspector_common_reports');
            $table->string('company_response');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->foreignId('reviewer_id')->references('reviewer_id')->on('reviewers')->cascadeOnDelete();
            $table->foreignId('company_id')->references('company_id')->on('companies')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_reports');
    }
};
