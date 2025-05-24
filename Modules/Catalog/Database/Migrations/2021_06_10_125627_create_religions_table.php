<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReligionsTable extends Migration {

	public function up()
	{
		Schema::create('religions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->tinyInteger('status')->default('1');
			$table->timestamp('deleted_at')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('religions');
	}
}