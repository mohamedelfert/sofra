<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	public function up()
	{
		Schema::create('transactions', function(Blueprint $table) {
			$table->increments('id');
			$table->decimal('amount');
			$table->text('notes');
			$table->integer('restaurant_id')->unsigned();
			$table->datetime('date');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('transactions');
	}
}