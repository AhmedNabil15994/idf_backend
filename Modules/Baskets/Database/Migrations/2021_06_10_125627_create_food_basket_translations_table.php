<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoodBasketTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('food_basket_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('description')->nullable();
			$table->string('locale');
			$table->integer('food_basket_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('food_basket_translations');
	}
}