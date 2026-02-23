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
            $table->string('daily_activity')->change();
            $table->string('fruit_consumption')->change();
            $table->string('antihypertensive_medication')->change();
            $table->string('elevated_glucose')->change();
            $table->string('family_history')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->integer('daily_activity')->change();
            $table->integer('fruit_consumption')->change();
            $table->integer('antihypertensive_medication')->change();
            $table->integer('elevated_glucose')->change();
            $table->integer('family_history')->change();
        });
    }
};
