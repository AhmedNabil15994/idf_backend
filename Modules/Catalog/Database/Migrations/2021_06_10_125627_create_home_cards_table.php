<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHomeCardsTable extends Migration {

	public function up()
	{
		Schema::create('home_cards', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('status')->default('0');
			$table->string('title',500)->nullable();
			$table->string('sub_title',500)->nullable();
			$table->string('link')->nullable();
			$table->string('color')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('home_cards');
	}
}