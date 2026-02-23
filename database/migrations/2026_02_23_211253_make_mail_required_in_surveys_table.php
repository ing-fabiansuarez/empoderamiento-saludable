<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fill any existing null values before making the column not-nullable
        DB::table('surveys')->whereNull('mail')->update(['mail' => '']);

        Schema::table('surveys', function (Blueprint $table): void {
            $table->string('mail')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('surveys', function (Blueprint $table): void {
            $table->string('mail')->nullable()->change();
        });
    }
};
