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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->unsignedBigInteger('class_id'); // To store class ID
            $table->string('class_name'); // To store class name
            $table->string('class_arm'); // To store class arm
            $table->string('profile_image'); // To store the image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
