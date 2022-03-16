<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique();
            $table->string('password');
            $table->enum('gender', array('male', 'female'));
            $table->date('d_o_b');
            $table->integer('region_id')->unsigned();
            $table->string('role_name');
            $table->string('status');
            $table->string('api_token', 60)->unique()->nullable();
            $table->string('pin_code')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        App\User::create([
            'name' => 'Admin',
            'email' => 'admin@sofra.com',
            'phone' => '01153225410',
            'password' => bcrypt(123456),
            'gender' => 'male',
            'd_o_b' => '1995-01-19',
            'region_id' => '1',
            'role_name' => 'superAdmin',
            'status' => 'active',
            'api_token' => null,
            'pin_code' => null,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
