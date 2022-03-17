<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	public function up()
	{
		Schema::create('items', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->text('description');
			$table->decimal('price');
			$table->decimal('offer_price')->nullable();
			$table->string('preparing_time');
			$table->string('image');
			$table->integer('restaurant_id')->unsigned();
			$table->enum('status', array('enabled', 'disabled'));
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('items');
	}
}