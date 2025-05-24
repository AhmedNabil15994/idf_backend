<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountryTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('country_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('locale');
			$table->integer('country_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('country_translations');
	}
}