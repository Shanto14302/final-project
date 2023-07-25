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
        Schema::create('admin_profiles', function (Blueprint $table) {
            $table->id('profile_id');
            $table->integer('profile_user_id');
            $table->integer('profile_employee_id');
            $table->string('profile_user_image');
            $table->string('profile_user_father_name');
            $table->string('profile_user_mother_name');
            $table->string('profile_user_gender');
            $table->text('profile_user_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_profiles');
    }
};
