<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimePeriodToRecurringDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recurring_donations', function (Blueprint $table) {
            
			$table->string('time_period')->nullable();
			$table->date('end_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recurring_donations', function (Blueprint $table) {
            $table->dropColumn(["time_period","end_at"]);
        });
    }
}
