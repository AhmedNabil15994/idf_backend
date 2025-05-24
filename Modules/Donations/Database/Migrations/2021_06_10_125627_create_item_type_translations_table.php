<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemTypeTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('item_type_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('locale');
			$table->integer('item_type_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('item_type_translations');
	}
}