<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSortToDonationPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donation_prices', function (Blueprint $table) {
            $table->integer("sort")->nullable();
			$table->tinyInteger('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donation_prices', function (Blueprint $table) {
            $table->dropColumn(["sort","status"]);
        });
    }
}
