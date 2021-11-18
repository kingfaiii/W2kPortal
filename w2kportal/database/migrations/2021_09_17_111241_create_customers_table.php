<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_email');
            $table->string('customer_fname');
            $table->string('customer_lname');
            $table->string('customer_status');
            $table->string('last_activity')->nullable();
            $table->string('reason_hold')->nullable();
            $table->string('reason_lost')->nullable();
            $table->date('reason_hold_date')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('first_email')->nullable();
            $table->string('second_email')->nullable();
            $table->string('third_email')->nullable();
            $table->string('fourth_email')->nullable();
            $table->string('fifth_email')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
