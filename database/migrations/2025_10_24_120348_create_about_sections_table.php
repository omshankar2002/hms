<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
public function up()
{
    Schema::create('about_sections', function (Blueprint $table) {
        $table->id();
        $table->string('heading')->nullable();
        $table->string('sub_heading')->nullable();
        $table->text('description')->nullable();
        $table->json('features')->nullable(); // list items store करने के लिए
        $table->string('image')->nullable();
        $table->string('video_url')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_sections');
    }
};
