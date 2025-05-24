<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamiliesTable extends Migration {

	public function up()
	{
		Schema::create('families', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('members_count');
			$table->unsignedInteger('charity_id')->nullable();
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('families');
	}
}