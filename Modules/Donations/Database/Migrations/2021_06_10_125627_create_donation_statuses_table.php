<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationStatusesTable extends Migration {

	public function up()
	{
		Schema::create('donation_statuses', function(Blueprint $table) {
			$table->increments('id');
			$table->string('code');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donation_statuses');
	}
}