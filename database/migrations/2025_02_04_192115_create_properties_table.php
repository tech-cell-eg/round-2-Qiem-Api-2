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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('address');
            $table->enum('type',['سكني' , 'تجاري']);
            $table->integer('area');
            $table->string('city');
            $table->string('region');
            $table->string('details');
            $table->string('advantages');
            $table->string('notes')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property');
    }
};
