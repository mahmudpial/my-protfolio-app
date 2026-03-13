<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            // category already exists — only add what's missing
            if (!Schema::hasColumn('skills', 'years_exp')) {
                $table->unsignedTinyInteger('years_exp')->nullable()->after('category');
            }
        });
    }

    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumnIfExists('years_exp');
        });
    }
};