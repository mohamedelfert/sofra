<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->text('commission_text');
			$table->text('about_app');
			$table->string('phone');
			$table->string('email');
			$table->decimal('commission');
			$table->string('fb_url');
			$table->string('tw_url');
			$table->string('insta_url');
			$table->string('android_url');
			$table->string('ios_url');
			$table->string('bank_account');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}