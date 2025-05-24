<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegionTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('region_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('locale');
			$table->integer('region_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('region_translations');
	}
}