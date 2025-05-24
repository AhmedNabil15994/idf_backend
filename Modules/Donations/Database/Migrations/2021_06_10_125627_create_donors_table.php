<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonorsTable extends Migration {

	public function up()
	{
		Schema::create('donors', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('status')->default('1');
			$table->unsignedBigInteger('user_id')->nullable();
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donors');
	}
}