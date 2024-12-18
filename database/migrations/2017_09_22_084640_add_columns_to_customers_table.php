<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('afm')->nullable();
            $table->string('tel')->nullable();
            $table->string('tel2')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('doy')->nullable();
            $table->string('brand')->nullable();
            $table->string('incharge')->nullable();
            $table->string('state')->nullable();
            $table->string('job')->nullable();
            $table->boolean('active')->default(1);        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
}
