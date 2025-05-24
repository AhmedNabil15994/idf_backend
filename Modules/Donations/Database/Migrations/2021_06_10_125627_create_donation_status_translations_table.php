<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationStatusTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('donation_status_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('locale');
			$table->unsignedInteger('donation_status_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donation_status_translations');
	}
}