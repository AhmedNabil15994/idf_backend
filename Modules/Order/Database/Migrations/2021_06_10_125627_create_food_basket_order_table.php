<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoodBasketOrderTable extends Migration {

	public function up()
	{
		Schema::create('food_basket_order', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('food_basket_id');
			$table->unsignedInteger('order_id');
            $table->float('quantity');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('food_basket_order');
	}
}