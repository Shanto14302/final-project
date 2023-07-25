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
        Schema::create('reset_password_permissions', function (Blueprint $table) {
            $table->id('reset_id');
            $table->integer('reset_user_id');
            $table->string('reset_email');
            $table->text('reset_status')->default('No');
            $table->string('reset_approved_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reset_password_permissions');
    }
};
