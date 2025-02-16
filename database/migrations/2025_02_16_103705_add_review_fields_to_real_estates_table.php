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
        Schema::table('real_estates', function (Blueprint $table) {
            $table->text('review_notes')->nullable()->after('reviewer_id');
            $table->string('review_file')->nullable()->after('review_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('real_estates', function (Blueprint $table) {
            $table->dropColumn(['review_notes', 'review_file']);
        });
    }
};
