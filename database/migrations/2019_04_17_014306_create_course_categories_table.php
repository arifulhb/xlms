<?php

use App\CourseCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->string('slug', 100)->unique();
            $table->string('description', 256)->nullable();
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


            /**
             * Nested
             */
            $table->integer('_lft')->unsigned()->default(0);
            $table->integer('_rgt')->unsigned()->default(0);
            $table->integer('parent_id')->unsigned()->nullable();

            $table->timestamps();
        });


        /**
         * Add Common Course Category
         */
        $categories = config('lms.course_categories');

        foreach($categories as $category){


            $new_category = $this->insertCategory($category, null);

            if (isset($category['child'])){

                foreach($category['child'] as $child){

                    echo 'Parent category:'. $new_category->name . ' --  '.$new_category->id.PHP_EOL;

                    $child['parent_id'] = $new_category->id;
                    $child_category = $this->insertCategory($child);
                }

            }
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_categories');
    }

    private function insertCategory(array $data){

        $data['slug']   = Str::slug($data['slug']);
        $data['created_by'] = 1; //default user admin
        $data['updated_by'] = 1; // default user admin

        $new_category = CourseCategory::create($data);
        $new_category->save();

        return $new_category;

    }
}
