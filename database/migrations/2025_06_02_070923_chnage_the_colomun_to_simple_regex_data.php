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
        Schema::table('regexData', function (Blueprint $table) {
             Schema::table('regexData', function (Blueprint $table) {
            $table->string('name')->unique(false)->change();
            $table->string('regex')->unique(false)->change();
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('regexData', function (Blueprint $table) {
            $table->string('name')->unique()->change();
            $table->string('regex')->unique()->change();
        });
    }
};
