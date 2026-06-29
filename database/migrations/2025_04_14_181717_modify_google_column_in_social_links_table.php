<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('social_links', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->text('google')->nullable()->change(); // or ->string(1000)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('social_links', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->string('google', 255)->nullable()->change(); // rollback ke liye
        });
    }
    
};
