<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phases', function (Blueprint $table) {
            $table->id('phase_id');
            $table->integer('phase_row_id');
            $table->integer('phase_student_id');
            $table->integer('phase_supervisor_id');
            $table->integer('phase_cosupervisor_id');
            $table->integer('phase_defence_topic')->nullable();
            $table->integer('phase_title_defence_start_date')->nullable();
            $table->integer('phase_title_defence_end_date')->nullable();
            $table->string('phase_title_defence_file')->nullable();
            $table->string('phase_title_defence_remark')->nullable();
            $table->string('phase_title_defence_status')->default('Pending');
            $table->integer('phase_pre_defence_start_date')->nullable();
            $table->integer('phase_pre_defence_end_date')->nullable();
            $table->string('phase_pre_defence_file')->nullable();
            $table->string('phase_pre_defence_remark')->nullable();
            $table->string('phase_pre_defence_status')->default('Pending');
            $table->integer('phase_final_defence_start_date')->nullable();
            $table->integer('phase_final_defence_end_date')->nullable();
            $table->string('phase_final_defence_file')->nullable();
            $table->string('phase_final_defence_remark')->nullable();
            $table->string('phase_final_defence_status')->default('Pending');
            $table->string('phase_status')->default(0)->comment('0=initial , 1=title defense , 2=pre defense , 3=final defense');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phases');
    }
};
