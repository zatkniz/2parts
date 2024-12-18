<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fund_code');
            $table->string('body');
            $table->string('price')->nullable();
            $table->string('cars')->nullable();
            $table->float('cost' , 10 , 2)->nullable();
            $table->string('car_model')->nullable();
            $table->float('payment' , 10 , 2)->nullable();
            $table->float('total' , 10 , 2)->default(0);
            $table->integer('user_id');
            $table->integer('last_user_id');
            $table->integer('customer_id');
            $table->boolean('isInvoice')->default(false);
            $table->boolean('isReceipt')->default(false);
            $table->boolean('hasPay')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funds');
    }
}
