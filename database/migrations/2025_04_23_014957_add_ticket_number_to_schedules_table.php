<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('schedules', 'ticket_number')) {
            Schema::table('schedules', function (Blueprint $table) {
                $table->string('ticket_number')->nullable()->after('id');
            });

            // Generate ticket numbers for existing records
            $schedules = DB::table('schedules')->whereNull('ticket_number')->get();
            foreach ($schedules as $schedule) {
                DB::table('schedules')
                    ->where('id', $schedule->id)
                    ->update([
                        'ticket_number' => strtoupper(Str::random(2)) . '-' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT)
                    ]);
            }

            // Now add the unique constraint
            Schema::table('schedules', function (Blueprint $table) {
                $table->unique('ticket_number');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('schedules', 'ticket_number')) {
            Schema::table('schedules', function (Blueprint $table) {
                $table->dropColumn('ticket_number');
            });
        }
    }
};
