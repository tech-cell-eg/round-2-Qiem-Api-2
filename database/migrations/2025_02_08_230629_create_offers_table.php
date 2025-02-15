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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->references('company_id')->on('companies')->cascadeOnDelete();
            $table->foreignId('real_estate_id')->references('id')->on('real_estates')->cascadeOnDelete();
            $table->string('details');
            $table->float('amount');
            $table->enum('status',['accepted','refused','hold on'])->default('hold on');
            $table->foreignId('client_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
