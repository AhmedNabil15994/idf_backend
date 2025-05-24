<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Modules\Order\Entities\Order;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
            $table->unsignedInteger('family_id');
            $table->unsignedInteger('volunteer_id')->nullable();
            $table->float('period')->nullable();
			$table->enum('status',Order::$status)->default('pending');
			$table->text('volunteer_note')->nullable();
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}