<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('name')->index();
            $table->string('brief', 255)->nullable();

            // introduction:: brief of the course
            $table->text('introduction')->nullable();

            // structure:: description, course outline, course flowchart, the estimated number of screens and course-learner contact time
            $table->text('structure')->nullable();

            $table->string('hours')->nullable();

            // key_takeway:: what you'll learn. Bulletpoints only
            $table->text('key_takeaway')->nullable();

            // course image thumbnail
            $table->string('thumbnail', 255)->nullable();
            $table->string('thumbnail_small', 255)->nullable();
            $table->string('thumbnail_large', 255)->nullable();

            $table->string('keywords', 255)->nullable();

            $table->tinyInteger('difficulty_level')->default(COURSE_DIFFICULTY_LEVEL_BEGINNER);
            $table->tinyInteger('status')->default(COURSE_STATUS_DRAFT);
            $table->string('language', 255)->nullable();

            $table->bigInteger('author_id')->unsigned()->nullable();

            //foreign keys
            $table->foreign('author_id')->references('id')->on('users');


            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();

            $table->foreign('created_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->foreign('updated_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');


            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('course_category_pivot', function (Blueprint $table) {

            $table->bigInteger('course_id')->unsigned();
            $table->integer('course_category_id')->unsigned();
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
        Schema::dropIfExists('courses');
        Schema::dropIfExists('course_category_pivot');
    }
}
