<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->float('payroll_period_01_1');
            $table->string('payroll_period_01_1_date')->nullable();
            $table->float('payroll_period_01_2');
            $table->string('payroll_period_01_2_date')->nullable();
            $table->float('payroll_period_01_3');
            $table->string('payroll_period_01_3_date')->nullable();
            $table->float('payroll_period_01_4');
            $table->string('payroll_period_01_4_date')->nullable();
            $table->float('payroll_period_01_5');
            $table->string('payroll_period_01_5_date')->nullable();
            $table->float('payroll_period_02_1');
            $table->string('payroll_period_02_1_date')->nullable();
            $table->float('payroll_period_02_2');
            $table->string('payroll_period_02_2_date')->nullable();
            $table->float('payroll_period_02_3');
            $table->string('payroll_period_02_3_date')->nullable();
            $table->float('payroll_period_02_4');
            $table->string('payroll_period_02_4_date')->nullable();
            $table->float('payroll_period_02_5');
            $table->string('payroll_period_02_5_date')->nullable();
            $table->integer('payroll_month');
            $table->integer('payroll_year');
            $table->float('enanti');
            $table->float('extras');
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
        Schema::dropIfExists('payrolls');
    }
}
