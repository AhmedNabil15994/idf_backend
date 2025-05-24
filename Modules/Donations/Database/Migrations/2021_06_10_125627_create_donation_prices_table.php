<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationPricesTable extends Migration {

	public function up()
	{
		Schema::create('donation_prices', function(Blueprint $table) {
			$table->increments('id');
			$table->float('price');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donation_prices');
	}
}