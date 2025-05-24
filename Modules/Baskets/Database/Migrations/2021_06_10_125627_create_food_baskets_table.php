<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoodBasketsTable extends Migration {

	public function up()
	{
		Schema::create('food_baskets', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('status')->default('1');
			$table->float('price');
			$table->float('quantity');
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('food_baskets');
	}
}