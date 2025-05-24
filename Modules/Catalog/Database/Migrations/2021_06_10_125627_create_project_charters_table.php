<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectChartersTable extends Migration {

	public function up()
	{
		Schema::create('project_charters', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('status')->default(0);
			$table->string('btn_title')->nullable();
			$table->string('title')->nullable();
			$table->text('description')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('project_charters');
	}
}