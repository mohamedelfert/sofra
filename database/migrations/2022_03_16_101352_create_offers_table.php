<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('description');
			$table->datetime('start_at');
			$table->datetime('end_at');
			$table->string('image');
			$table->integer('restaurant_id')->unsigned();
			$table->enum('status', array('available', 'unavailable'));
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}