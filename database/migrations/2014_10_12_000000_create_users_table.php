<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 256);
            $table->string('email', 100)->unique();
            $table->string('username', 100)->uniqid();
            $table->tinyInteger('status')->default(USER_STATUS_PENDING);
            $table->string('note', 256)->nullable();
            $table->string('profile_photo', 256)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        });


        /**
         * Create default admin
         */
         $user =[
            'name'              => 'Admin',
            'email'             => config('lms.admin'),
            'username'          => 'admin',
            'note'              => 'Admin user',
            'password'          => bcrypt(env('ADMIN_PASSWORD', '')),
            'status'            => USER_STATUS_ACTIVE,
            'email_verified_at' => Carbon::now(),
         ];
         $user = User::create($user);

         // teacher
         $teacher =[
            'name'              => 'Teacher',
            'email'             => 'teacher@lms.com',
            'username'          => 'teacher',
            'note'              => 'Test teacher',
            'password'          => bcrypt(env('ADMIN_PASSWORD', '')),
            'status'            => USER_STATUS_ACTIVE,
            'email_verified_at' => Carbon::now(),
         ];
         $teacher = User::create($teacher);

         // student
         $student =[
            'name'              => 'Student',
            'email'             => 'student@lms.com',
            'username'          => 'student',
            'note'              => 'Test student',
            'password'          => bcrypt(env('ADMIN_PASSWORD', '')),
            'status'            => USER_STATUS_ACTIVE,
            'email_verified_at' => Carbon::now(),
         ];
         $student = User::create($student);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
