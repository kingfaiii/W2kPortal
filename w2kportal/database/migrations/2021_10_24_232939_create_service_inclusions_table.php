<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use OwenIt\Auditing\Contracts\Auditable;

class CreateServiceInclusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_inclusions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_cost')->default('0.00');
            $table->string('won_id')->nullable();
            $table->string('package_id')->nullable();
            $table->string('book_id')->nullable();
            $table->string('service_name')->nullable();
            $table->string('layout')->nullable();
            $table->string('layout_by')->nullable();
            $table->string('page_count')->nullable();
            $table->string('page_count_by')->nullable();
            $table->string('project_classification')->nullable();
            $table->string('project_classification_by')->nullable();
            $table->string('turnaround_time')->nullable();
            $table->string('turnaround_time_by')->nullable();
            $table->string('status')->nullable();
            $table->string('status_by')->nullable();
            $table->string('task')->nullable();
            $table->string('commitment_date')->nullable();
            $table->string('commitment_date_by')->nullable();
            $table->string('owner')->nullable();
            $table->string('owner_by')->nullable();
            $table->string('job_cost')->nullable();
            $table->string('job_cost_by')->nullable();
            $table->string('date_assigned')->nullable();
            $table->string('date_assigned_old')->nullable();
            $table->string('date_assigned_by')->nullable();
            $table->string('date_completed')->nullable();
            $table->string('date_completed_by')->nullable();
            $table->string('quality_assurance')->nullable();
            $table->string('quality_assurance_by')->nullable();
            $table->string('quality_score')->nullable();
            $table->string('quality_score_by')->nullable();
            $table->string('uid')->nullable();
            $table->string('uid_by')->nullable();
            $table->string('project_link')->nullable();
            $table->string('project_link_by')->nullable();
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
        Schema::dropIfExists('service_inclusions');
    }
}
