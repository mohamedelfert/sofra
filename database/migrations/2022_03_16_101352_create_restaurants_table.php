<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('email')->unique();
			$table->string('phone')->unique();
			$table->string('second_phone')->unique();
			$table->string('password');
			$table->integer('region_id')->unsigned();
			$table->decimal('minimum_order');
			$table->decimal('delivery_fee');
			$table->string('whatsapp')->unique();
			$table->string('image');
			$table->enum('status', array('open', 'close'));
			$table->integer('is_active')->default('1');
			$table->string('api_token', 60)->unique()->nullable();
			$table->string('pin_code')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}