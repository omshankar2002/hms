<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneToContactsTable extends Migration
{
    public function up()
{
    // Check करें कि 'phone' कॉलम पहले से मौजूद नहीं है
    if (!Schema::hasColumn('contact_messages', 'phone')) {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('phone')->after('subject');
        });
    }
}

public function down()
{
    // Check करें कि 'phone' कॉलम मौजूद है
    if (Schema::hasColumn('contact_messages', 'phone')) {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
}
}