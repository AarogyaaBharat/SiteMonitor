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
        Schema::create('page_speed_metrics', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('url');
            $table->enum('strategy', ['mobile', 'desktop']);
            $table->decimal('fcp', 8, 2); // First Contentful Paint (ms)
            $table->decimal('lcp', 8, 2); // Largest Contentful Paint (ms)
            $table->decimal('cls', 8, 4); // Cumulative Layout Shift
            $table->decimal('tbt', 8, 2); // Total Blocking Time (ms)
            $table->decimal('si', 8, 2);  // Speed Index (ms)
            $table->decimal('score', 5, 2); // Performance score (0-100)
            $table->text('screenshot')->nullable(); // Base64 screenshot
            $table->timestamps();
            
            $table->index(['url', 'strategy']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_speed_metrics');
    }
};
