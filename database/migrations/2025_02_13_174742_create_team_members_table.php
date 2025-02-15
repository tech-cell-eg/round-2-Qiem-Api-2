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
        if (!Schema::hasTable('team_members')) {
            Schema::create('team_members', function (Blueprint $table) {
                $table->id();
                $table->enum('role', ['Inspector', 'Reviewer']);
                
                // Assuming 'inspector_id' is the primary key in 'inspectors'
                $table->foreignId('inspector_id')->nullable()->constrained('inspectors', 'inspector_id')->onDelete('cascade');
                
                // If 'reviewers' uses 'id' as the primary key, update the foreign key
                $table->foreignId('reviewer_id')->nullable()->constrained('reviewers', 'reviewer_id')->onDelete('cascade');
                
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
