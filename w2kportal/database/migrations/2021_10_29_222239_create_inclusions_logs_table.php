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
            $table->string('log_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('won_id')->nullable();
            $table->string('package_id')->nullable();
            $table->string('book_id')->nullable();
            $table->string('service_name')->nullable();
            $table->string('layout')->nullable();
            $table->string('page_count')->nullable();
            $table->string('project_classification')->nullable();
            $table->string('turnaround_time')->nullable();
            $table->string('status')->nullable();
            $table->string('task')->nullable();
            $table->string('commitment_date')->nullable();
            $table->string('owner')->nullable();
            $table->string('job_cost')->nullable();
            $table->string('date_assigned')->nullable();
            $table->string('date_completed')->nullable();
            $table->string('quality_assurance')->nullable();
            $table->string('quality_score')->nullable();
            $table->string('uid')->nullable();
            $table->string('project_link')->nullable();
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
