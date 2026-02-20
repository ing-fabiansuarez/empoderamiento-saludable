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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('gender');
            $table->integer('age');
            $table->float('weight');
            $table->float('height');
            $table->float('waist');
            $table->integer('act');
            $table->integer('food');
            $table->integer('htn');
            $table->integer('glu');
            $table->integer('fam');
            $table->float('bmi');
            $table->integer('score');
            $table->string('risk_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
