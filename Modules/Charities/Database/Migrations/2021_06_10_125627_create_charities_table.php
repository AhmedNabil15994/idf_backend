<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCharitiesTable extends Migration {

	public function up()
	{
		Schema::create('charities', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedBigInteger('user_id');
			$table->tinyInteger('status')->default('1');
			$table->string('address')->nullable();
			$table->string('phone');
			$table->string('whats_app')->nullable();
			$table->string('facebook')->nullable();
			$table->timestamp('deleted_at')->nullable();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('charities');
	}
}