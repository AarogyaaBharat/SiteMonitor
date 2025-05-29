<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::table('page_speed_metrics', function (Blueprint $table) {
            $table->decimal('best_practices_score', 5, 2)->after('score')->nullable();
            $table->decimal('accessibility_score', 5, 2)->after('best_practices_score')->nullable();
            $table->decimal('seo_score', 5, 2)->after('accessibility_score')->nullable();
        });
    }

    public function down()
    {
        Schema::table('page_speed_metrics', function (Blueprint $table) {
            $table->dropColumn(['best_practices_score', 'accessibility_score', 'seo_score']);
        });
    }
};
