<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	public function up()
	{
		Schema::create('projects', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('country_id')->unsigned()->nullable();
			$table->enum('type',['project','link'])->nullable();
			$table->string('link')->nullable();
			$table->tinyInteger('status')->default('1');
			$table->float('amount_to_collect')->nullable();
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('projects');
	}
}