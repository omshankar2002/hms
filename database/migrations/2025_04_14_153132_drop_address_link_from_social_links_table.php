<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('social_links', 'address_link')) {
            Schema::table('social_links', function (Blueprint $table) {
                $table->dropColumn('address_link');
            });
        }
    }
    
    public function down()
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->string('address_link')->nullable();  // Re-adding the column if needed
        });
    }
    
};
