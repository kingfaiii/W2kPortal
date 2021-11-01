<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInclusionsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inclusions_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_id')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('won_id')->nullable();
            $table->string('package_id')->nullable();
            $table->string('book_id')->nullable();
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
        Schema::dropIfExists('inclusions_logs');
    }
}
