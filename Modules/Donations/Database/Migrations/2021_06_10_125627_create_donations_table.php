<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationsTable extends Migration {

	public function up()
	{
		Schema::create('donations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('donor_id')->unsigned()->nullable();
			$table->float('total');
			$table->text('PaymentID')->nullable();
			$table->enum('status',['cart','pending','paid'])->default('cart');
			$table->enum('donor_type',['helpful','quick_donation'])->default('quick_donation');
			$table->string('name')->nullable();
			$table->string('email')->nullable();
			$table->string('mobile')->nullable();
			$table->string('payment_method')->nullable();
			$table->unsignedInteger('donation_status_id')->nullable();
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donations');
	}
}