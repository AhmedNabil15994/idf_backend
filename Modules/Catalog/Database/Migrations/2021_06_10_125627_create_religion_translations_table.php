<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReligionTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('religion_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('locale');
			$table->integer('religion_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('religion_translations');
	}
}