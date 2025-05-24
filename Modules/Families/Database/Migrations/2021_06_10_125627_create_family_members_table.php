<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamilyMembersTable extends Migration {

	public function up()
	{
		Schema::create('family_members', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('family_id')->unsigned();
			$table->integer('nationality_id')->unsigned();
			$table->integer('religion_id')->unsigned();
			$table->string('national_id');
			$table->string('name');
			$table->enum('type', array('leader', 'member'));
			$table->enum('gender', array('male', 'female'))->nullable();
			$table->string('phone')->nullable();
			$table->float('current_salary')->nullable();
			$table->enum('marital_status', array('married', 'single', 'widower', 'divorce'))->nullable();
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('family_members');
	}
}