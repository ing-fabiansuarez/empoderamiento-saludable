<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surveys', function (Blueprint $table): void {
            $table->dropColumn(['names', 'surnames']);
            $table->boolean('has_diabetes')->default(false)->after('mail');
        });
    }

    public function down(): void
    {
        Schema::table('surveys', function (Blueprint $table): void {
            $table->string('names')->after('uuid');
            $table->string('surnames')->after('names');
            $table->dropColumn('has_diabetes');
        });
    }
};
