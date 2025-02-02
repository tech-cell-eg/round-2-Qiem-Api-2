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
            $table->foreignId('inspector_id')->references('id')->on('users')->cascadeOnDelete();
            $table->primary('inspector_id');
            $table->string('national_id')->unique();
            $table->string('years of experience');
            $table->string('field of experience');
            $table->string('fee');
            $table->enum('balance',['account_balance','outstanding_balance']);
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
