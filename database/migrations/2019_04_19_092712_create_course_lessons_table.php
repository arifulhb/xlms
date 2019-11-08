<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('course_module_id')->unsigned();
            $table->string('title', 256);
            $table->text('description')->nullable();
            $table->smallInteger('type')->default(LESSON_TYPE_VIDEO); // Lesson types {Video, Audio, Document, PDF, Image}
            $table->string('resource_path', 256)->nullable();
            $table->integer('duration_in_minutes')->nullable();
            $table->smallInteger('position')->default(1);

            $table->string('thumbnail_original', 256)->nullable();
            $table->string('thumbnail_small', 256)->nullable();
            $table->string('thumbnail_medium', 256)->nullable();

            $table->foreign('course_module_id')
                    ->references('id')
                    ->on('course_modules')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('course_lessons');
    }
}
