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
        Schema::create('inspector_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspector_id')->references('inspector_id')->on('inspectors')->cascadeOnDelete();
            $table->string('evaluation_date');
            $table->string('instrument_date');
            $table->enum('infrastructure', ['yes', 'no'])->default('no');
            $table->string('instrument_number');
            $table->string('property_location');
            $table->string('property_code');
            $table->string('Source');
            $table->float('distance');
            $table->float('Entry_date');
            $table->json('property_boundaries');
            $table->string('within_range');
            $table->string('attributed');
            $table->string('building_condition');
            $table->text('general_description_of_finishing');
            $table->integer('number_of_floor');
            $table->string('evaluation_of_floors');
            $table->string('land_evaluation');
            $table->string('building_evaluation');
            $table->float('total_property_coast');
            $table->float('marketing_value');
            $table->string('property_comparisons');
            $table->string('measurement');
            $table->string('general_notes');
            $table->string('photos_of_property');
            $table->string('file');
            $table->string('property_type');
            $table->text('property_description');
            $table->string('property_age');
            $table->enum('Ready_to_use', ['yes', 'no'])->default('yes');
            $table->foreignId('service_id')->references('id')->on('services')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspector_reports');
    }
};
