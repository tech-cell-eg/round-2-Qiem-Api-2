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
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'inspector_id')) {
                $table->unsignedBigInteger('inspector_id')->nullable();
                $table->index('inspector_id');
    
                // Ensure inspector_id exists in inspectors before creating FK
                if (Schema::hasTable('inspectors')) {
                    $table->foreign('inspector_id')->references('id')->on('inspectors')->onDelete('cascade');
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'inspector_id')) {
                // Check if foreign key exists before dropping
                Schema::disableForeignKeyConstraints();
                $table->dropForeign(['inspector_id']);
                Schema::enableForeignKeyConstraints();
    
                $table->dropIndex(['inspector_id']);
                $table->dropColumn('inspector_id');
            }
        });
    }
};
