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
        Schema::table('surveys', function (Blueprint $table) {
            $table->renameColumn('act', 'daily_activity');
            $table->renameColumn('food', 'fruit_consumption');
            $table->renameColumn('htn', 'antihypertensive_medication');
            $table->renameColumn('glu', 'elevated_glucose');
            $table->renameColumn('fam', 'family_history');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->renameColumn('daily_activity', 'act');
            $table->renameColumn('fruit_consumption', 'food');
            $table->renameColumn('antihypertensive_medication', 'htn');
            $table->renameColumn('elevated_glucose', 'glu');
            $table->renameColumn('family_history', 'fam');
        });
    }
};
