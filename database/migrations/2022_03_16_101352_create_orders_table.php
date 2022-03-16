<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->text('address');
			$table->text('notes')->nullable();
			$table->decimal('cost');
			$table->decimal('delivery_cost');
			$table->decimal('total');
			$table->integer('restaurant_id')->unsigned();
			$table->integer('payment_method_id')->unsigned();
			$table->datetime('delivery_at');
			$table->enum('status', array('pending', 'accepted', 'rejected'));
			$table->decimal('commission');
			$table->boolean('client_delivery_confirm')->default(0);
			$table->boolean('restaurant_delivery_confirm')->default(0);
			$table->enum('cart', array('created', 'incompleted', 'completed', 'ordered'));
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}