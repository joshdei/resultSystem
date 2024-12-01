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
        Schema::create('store_student_scores', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('teacher_id'); // Foreign key for the teacher
            $table->unsignedBigInteger('student_id'); // Foreign key for the student
            $table->integer('marks'); // Total score after processing
            $table->unsignedBigInteger('class_id'); // Foreign key for the class
            $table->timestamps(); // Created at and updated at columns

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_student_scores');
    }
};
