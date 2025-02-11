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
        Schema::create('report', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspector_id')->constrained()->onDelete('cascade');
            $table->integer('property_code');
            $table->date('evaluation_date');
            $table->string('general_dscription');
            $table->string('location_dscription');
            $table->integer('instrument_number');
            $table->integer('instrument_date');
            $table->string('property_type');
            $table->enum('infrastructure' , ['نعم' , 'لا']);
            $table->string('services');
            $table->enum('ready_to_use' , ['تحت الانشاء' , 'جاهز' , 'فضاء']);
            $table->integer('number');
            $table->integer('part_number');
            $table->string('source');
            $table->string('entry_type');
            $table->integer('space');
            $table->integer('north');
            $table->integer('north_height');
            $table->integer('south');
            $table->integer('south_height');
            $table->integer('east');
            $table->integer('east_height');
            $table->integer('west');
            $table->integer('west_height');
            $table->integer('elevation');
            $table->string('property_status');
            $table->string('finishing_description');
            $table->integer('number_of_floors');
            $table->string('land_rating');
            $table->string('buildings_rating');
            $table->string('total_property_costs');
            $table->integer('marketing_value');
            $table->string('property_comparisons');
            $table->string('conflict_of_interest');
            $table->integer('measurement');
            $table->string('preview');
            $table->string('general_inspectors_comments');
            $table->string('property_images');
            $table->string('report_copy');
            $table->string('final_report');
            $table->timestamps();
        });
        
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};
