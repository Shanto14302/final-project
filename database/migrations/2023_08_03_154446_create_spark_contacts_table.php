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
        Schema::create('spark_contacts', function (Blueprint $table) {
            $table->id('spark_contact_id');
            $table->string('spark_phone_1')->nullable();
            $table->string('spark_phone_2')->nullable();
            $table->string('spark_phone_3')->nullable();
            $table->string('spark_email')->nullable();
            $table->string('spark_facebook_link')->nullable();
            $table->string('spark_instagram_link')->nullable();
            $table->string('spark_youtube_link')->nullable();
            $table->string('spark_twitter_link')->nullable();
            $table->text('spark_location_link')->nullable();
            $table->string('spark_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spark_contacts');
    }
};
