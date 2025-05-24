<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryProjectTable extends Migration {

	public function up()
	{
		Schema::create('category_project', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedBigInteger('category_id');
            $table->integer('project_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('category_project');
	}
}