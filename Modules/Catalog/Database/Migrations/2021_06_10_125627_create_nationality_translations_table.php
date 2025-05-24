<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNationalityTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('nationality_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('locale');
			$table->integer('nationality_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nationality_translations');
	}
}