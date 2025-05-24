<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('project_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('slug')->nullable();
			$table->text('description')->nullable();
			$table->string('locale');
			$table->integer('project_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('project_translations');
	}
}