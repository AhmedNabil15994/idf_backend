<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCharityFamilyTable extends Migration {

	public function up()
	{
		Schema::create('charity_family', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('family_id')->unsigned();
			$table->integer('charity_id')->unsigned();
			$table->text('support_type')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('charity_family');
	}
}