<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('content');
			$table->integer('notificationable_id');
			$table->string('notificationable_type');
			$table->boolean('is_read');
			$table->integer('order_id')->unique()->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}