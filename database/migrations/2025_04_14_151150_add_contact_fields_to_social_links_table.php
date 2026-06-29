<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('social_links', function (Blueprint $table) {
        if (!Schema::hasColumn('social_links', 'phone'))   $table->string('phone')->nullable()->after('id');
        if (!Schema::hasColumn('social_links', 'gmail'))   $table->string('gmail')->nullable()->after('phone');
        if (!Schema::hasColumn('social_links', 'address')) $table->string('address')->nullable()->after('gmail');
    });
}

public function down()
{
    Schema::table('social_links', function (Blueprint $table) {
        $table->dropColumn(['phone', 'gmail', 'address']);
    });
}
};
