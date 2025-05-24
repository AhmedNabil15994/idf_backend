<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonateResourceItemsTable extends Migration {

	public function up()
	{
		Schema::create('donate_resource_items', function(Blueprint $table) {
			$table->increments('id');
			$table->text('categories');
			$table->float('quantity');
			$table->integer('item_type_id')->unsigned()->nullable();
			$table->integer('donate_resource_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donate_resource_items');
	}
}