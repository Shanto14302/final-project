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
        Schema::create('spark_main_sliders', function (Blueprint $table) {
            $table->id('spark_main_slider_id');
            $table->string('spark_main_slider_image');
            $table->text('spark_main_slider_status')->default('Active');
            $table->integer('spark_main_slider_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spark_main_sliders');
    }
};
