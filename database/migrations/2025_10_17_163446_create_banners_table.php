<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('banners', function (Blueprint $table) {
        $table->id();
        $table->string('subtitle')->nullable(); // Trusted by 500+ Companies
        $table->string('title')->nullable();    // Modern Warehouse Solutions...
        $table->text('description')->nullable(); // Paragraph
        $table->string('button_text')->nullable();
        $table->string('button_url')->nullable();
        $table->integer('clients_count')->nullable();
        $table->string('uptime')->nullable();  // Store as string e.g. "99.9%"
        $table->string('support_hours')->nullable(); // e.g. "24/7"
        $table->string('background_image')->nullable();
        $table->string('hero_image_1')->nullable(); // map
        $table->string('hero_image_2')->nullable(); // truck
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
