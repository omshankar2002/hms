<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Check करें कि 'status' कॉलम पहले से exists नहीं है
        if (!Schema::hasColumn('faqs', 'status')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->tinyInteger('status')->default(1)->after('answer');
            });
        }
    }
    
    public function down()
    {
        // Check करें कि 'status' कॉलम exists है
        if (Schema::hasColumn('faqs', 'status')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
