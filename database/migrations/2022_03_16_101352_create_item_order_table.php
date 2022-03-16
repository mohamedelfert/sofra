<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemOrderTable extends Migration {

	public function up()
	{
		Schema::create('item_order', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('item_id')->unsigned();
			$table->integer('order_id')->unsigned();
			$table->decimal('price');
			$table->integer('quantity');
			$table->text('notes')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('item_order');
	}
}