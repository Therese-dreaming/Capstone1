<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('service_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('contact_number');
            $table->date('service_date');
            $table->time('service_schedule');
            $table->string('venue');
            $table->string('document_path')->nullable();
            $table->enum('status', ['pending', 'approved', 'completed', 'cancelled'])->default('pending');
            $table->foreignId('priest_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};