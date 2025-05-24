<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonatablesTable extends Migration {

	public function up()
	{
		Schema::create('donatables', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('donation_id')->unsigned();
			$table->string('donatable_type');
			$table->integer('donatable_id');
			$table->float('amount');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donatables');
	}
}