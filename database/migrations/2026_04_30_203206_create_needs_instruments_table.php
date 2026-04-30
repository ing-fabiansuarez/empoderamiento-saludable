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
        Schema::create('needs_instruments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('role');
            $table->string('risk_level');
            $table->string('barrier');
            $table->string('barrier_other')->nullable();
            $table->integer('perception_vs_reality');
            $table->text('failure_loop');
            $table->text('hopes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('needs_instruments');
    }
};
