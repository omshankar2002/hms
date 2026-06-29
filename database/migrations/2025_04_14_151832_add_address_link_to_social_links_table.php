<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('social_links', function (Blueprint $table) {
        if (!Schema::hasColumn('social_links', 'address_link'))
            $table->string('address_link')->nullable()->after('address');
    });
}

public function down()
{
    Schema::table('social_links', function (Blueprint $table) {
        $table->dropColumn('address_link');
    });
}

};
