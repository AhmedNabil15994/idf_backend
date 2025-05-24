<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressTable extends Migration {

	public function up()
	{
		Schema::create('address', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('city_id')->unsigned();
			$table->integer('family_id')->unsigned();
			$table->string('gada_number')->nullable();
			$table->string('region')->nullable();
			$table->string('street');
			$table->string('building_number');
			$table->string('floor_number');
			$table->string('ale_number');
			$table->string('apartment');
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('address');
	}
}