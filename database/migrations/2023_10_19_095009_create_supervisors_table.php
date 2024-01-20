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
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id('supervisor_id');
            $table->integer('supervisor_student_id');
            $table->integer('supervisor_student_choice_1')->nullable();
            $table->integer('supervisor_student_choice_2')->nullable();
            $table->integer('supervisor_student_choice_3')->nullable();
            $table->integer('supervisor_student_accepted')->nullable();
            $table->integer('cosupervisor_student_choice_1')->nullable();
            $table->integer('cosupervisor_student_choice_2')->nullable();
            $table->integer('cosupervisor_student_choice_3')->nullable();
            $table->integer('cosupervisor_student_accepted')->nullable();
            $table->text('supervisor_status')->default('Editable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisors');
    }
};
