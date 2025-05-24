<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCharityTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('charity_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('description')->nullable();
			$table->string('locale');
			$table->integer('charity_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('charity_translations');
	}
}