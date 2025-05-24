<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamilyFoodBasketTable extends Migration {

	public function up()
	{
		Schema::create('family_food_basket', function(Blueprint $table) {
			$table->increments('id');
			$table->float('quantity');
			$table->integer('family_id')->unsigned();
			$table->integer('food_basket_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('family_food_basket');
	}
}