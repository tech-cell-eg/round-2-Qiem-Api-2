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
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('street');
            $table->string('district');
            $table->string('city');
            $table->string('area');
            $table->string('region');
            $table->string('advantages');
            $table->string('more_details');
            $table->foreignId('client_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estates');
    }
};
