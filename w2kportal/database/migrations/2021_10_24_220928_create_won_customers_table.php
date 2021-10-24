<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWonCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('won_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('package_id');
            $table->string('customer_id');
            $table->string('status');
            $table->string('transaction_ID');
            $table->string('book_title');
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
        Schema::dropIfExists('won_customers');
    }
}
