<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->text('address');
            $table->text('notes')->nullable();
            $table->decimal('cost')->default('0');
            $table->decimal('delivery_cost')->default('0');
            $table->decimal('total')->default('0');
            $table->integer('restaurant_id')->unsigned();
            $table->integer('payment_method_id')->unsigned();
            $table->string('delivery_at');
            $table->enum('status', array('pending', 'accepted', 'rejected', 'completed', 'canceled'));
            $table->decimal('commission')->default('0');
            $table->boolean('client_delivery_confirm')->default(0);
            $table->boolean('restaurant_delivery_confirm')->default(0);
            $table->integer('client_id')->unsigned();
            $table->decimal('net')->default('0');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('orders');
    }
}
