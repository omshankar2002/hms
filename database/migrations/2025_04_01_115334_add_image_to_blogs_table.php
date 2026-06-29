<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('blogs')) {
            return; // table will be created later by create_blogs_table migration
        }
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }
    
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
    
};
