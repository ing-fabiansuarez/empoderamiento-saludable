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
            $table->string('gender')->nullable()->change();
            $table->integer('age')->nullable()->change();
            $table->float('weight')->nullable()->change();
            $table->float('height')->nullable()->change();
            $table->float('waist')->nullable()->change();
            $table->string('daily_activity')->nullable()->change();
            $table->string('fruit_consumption')->nullable()->change();
            $table->string('antihypertensive_medication')->nullable()->change();
            $table->string('elevated_glucose')->nullable()->change();
            $table->string('family_history')->nullable()->change();
            $table->float('bmi')->nullable()->change();
            $table->integer('score')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->string('gender')->nullable(false)->change();
            $table->integer('age')->nullable(false)->change();
            $table->float('weight')->nullable(false)->change();
            $table->float('height')->nullable(false)->change();
            $table->float('waist')->nullable(false)->change();
            $table->string('daily_activity')->nullable(false)->change();
            $table->string('fruit_consumption')->nullable(false)->change();
            $table->string('antihypertensive_medication')->nullable(false)->change();
            $table->string('elevated_glucose')->nullable(false)->change();
            $table->string('family_history')->nullable(false)->change();
            $table->float('bmi')->nullable(false)->change();
            $table->integer('score')->nullable(false)->change();
        });
    }
};
