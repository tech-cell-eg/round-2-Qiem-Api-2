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
        Schema::table('inspectors', function (Blueprint $table) {
            $table->decimal('account_balance', 10, 2)->default(0)->after('fee');
            $table->decimal('outstanding_balance', 10, 2)->default(0)->after('account_balance');
            $table->dropColumn('balance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
