<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemTypesTable extends Migration {

	public function up()
	{
		Schema::create('item_types', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('status')->default('1');
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('item_types');
	}
}