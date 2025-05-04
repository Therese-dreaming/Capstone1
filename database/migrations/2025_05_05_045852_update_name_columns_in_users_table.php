<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // First rename the existing 'name' column to 'first_name'
            $table->renameColumn('name', 'first_name');
            // Then add the new 'last_name' column
            $table->string('last_name')->after('first_name')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse the changes
            $table->renameColumn('first_name', 'name');
            $table->dropColumn('last_name');
        });
    }
};