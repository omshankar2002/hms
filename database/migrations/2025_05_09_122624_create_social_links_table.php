<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Skip if already created by the earlier migration + alter migrations
        if (Schema::hasTable('social_links')) {
            return;
        }
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('gmail')->nullable();
            $table->text('address')->nullable();
            $table->string('google')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_links');
    }
}
