<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('email')->unique();
			$table->string('phone')->unique();
			$table->string('password');
			$table->integer('region_id')->unsigned();
			$table->string('address');
			$table->string('image');
			$table->string('api_token', 60)->unique()->nullable();
			$table->string('pin_code')->nullable();
			$table->tinyInteger('is_active')->default('1');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}