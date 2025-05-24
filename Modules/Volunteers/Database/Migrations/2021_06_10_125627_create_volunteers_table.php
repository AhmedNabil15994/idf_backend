<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVolunteersTable extends Migration {

	public function up()
	{
		Schema::create('volunteers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->date('d_o_b')->nullable();
			$table->integer('charity_id')->nullable();
			$table->tinyInteger('status')->default('0');
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('volunteers');
	}
}