<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
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

            $table->timestamps();
        });

        /**
         * Create User Deparment Relationship
         */
        Schema::create('user_department_pivot', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->integer('department_id')->unsigned();
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
        Schema::dropIfExists('departments');
        Schema::dropIfExists('user_department_pivot');

    }
}
