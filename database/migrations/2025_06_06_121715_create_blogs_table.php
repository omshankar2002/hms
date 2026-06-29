<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('blogs')) {
            return;
        }
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('tags')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('blog_categories')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
