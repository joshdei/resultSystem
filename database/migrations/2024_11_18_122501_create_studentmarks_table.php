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
        Schema::create('studentmarks', function (Blueprint $table) {
            $table->id();
                $table->string('teacher_id');
                $table->string('school_session');
                $table->string('student_id');
                $table->string('class_id');
                $table->string('term');
                $table->integer('attendance');
                $table->json('marks');
                $table->integer('class_participation');
                $table->integer('school_attendance');
                $table->integer('concentration');
                $table->integer('attitude_to_property');
                $table->integer('assignment');
                $table->integer('cleanliness');
                $table->integer('punctuality');
                $table->integer('general_conduct');
                $table->text('class_remark');
                $table->text('head_remark');
                $table->integer('outstanding_fees');
                $table->integer('next_term_fees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentmarks');
    }
};
