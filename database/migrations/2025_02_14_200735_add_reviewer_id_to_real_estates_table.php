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

            $table->unsignedBigInteger('reviewer_id')->nullable()->after('client_id');
            $table->foreign('reviewer_id')->references('reviewer_id')->on('reviewers')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('real_estates', function (Blueprint $table) {

            $table->dropForeign(['reviewer_id']);
            $table->dropColumn('reviewer_id');

        });
    }
};
