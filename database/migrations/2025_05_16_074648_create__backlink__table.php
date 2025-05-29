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
      Schema::create('backlinks', function (Blueprint $table) {
    $table->id();
    $table->string('target_url'); // Your website's URL
    $table->string('source_url'); // URL linking to you
    $table->string('anchor_text')->nullable();
    $table->integer('source_domain_authority')->nullable();
    $table->integer('source_page_authority')->nullable();
    $table->boolean('dofollow')->default(true);
    $table->timestamp('first_seen_at');
    // $table->timestamp('last_seen_at');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backlinks');
    }
};
