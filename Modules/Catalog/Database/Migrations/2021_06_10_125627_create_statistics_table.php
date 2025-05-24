<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatisticsTable extends Migration {

	public function up()
	{
		Schema::create('statistics', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('status')->default('0');
			$table->json('title')->nullable();
			$table->json('sub_title')->nullable();
			$table->string('value')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('statistics');
	}
}