<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecurringDonationsTable extends Migration {

	public function up()
	{
		Schema::create('recurring_donations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->enum('status',['pending','failed','paid'])->default('pending');
			$table->float('total');
			$table->string('RecurringId')->nullable();
			$table->json('pending_response')->nullable();
			$table->json('failed_response')->nullable();
			$table->json('paid_response')->nullable();
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('recurring_donations');
	}
}