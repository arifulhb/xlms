<?php

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name')->nullable();
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name')->nullable();
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('permission_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type', ]);

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(['permission_id', $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('role_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type', ]);

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['role_id', $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });


        /**
         * Create 3 default roles
         */
         $role_admin = Role::create(['name' => USER_ROLE_ADMIN]);
         $role_teacher = Role::create(['name' => USER_ROLE_INSTRUCTOR]);
         $role_student = Role::create(['name' => USER_ROLE_STUDENT]);

         /**
          * Create associate permissions
          */
        $create_user  = Permission::create(['name' => 'Create user']);
        $edit_user    = Permission::create(['name' => 'Edit user']);
        $delete_user  = Permission::create(['name' => 'Delete user']);
        $block_user  = Permission::create(['name' => 'Block user']);
        $unblock_user  = Permission::create(['name' => 'Unblock user']);
        $unsuspend_user  = Permission::create(['name' => 'Unsuspend user']);

        $view_report      = Permission::create(['name' => 'View report']);

        $create_course    = Permission::create(['name' => 'Create course']);
        $edit_course      = Permission::create(['name' => 'Edit course']);
        $delete_course    = Permission::create(['name' => 'Delete course']);

        $create_quiz  = Permission::create(['name' => 'Create quiz']);
        $edit_quiz    = Permission::create(['name' => 'Edit quiz']);
        $delete_quiz  = Permission::create(['name' => 'Delete quiz']);

        $role_admin->givePermissionTo([$create_course, $edit_course, $delete_course, $block_user, $unblock_user, $unsuspend_user,
                                        $create_course, $edit_course, $delete_course, $create_quiz, $edit_quiz, $delete_quiz,
                                        $view_report]);

        $role_teacher->givePermissionTo([$create_course, $edit_course, $delete_course, $create_quiz, $edit_quiz, $delete_quiz]);


        $admin_user = User::where('email', config('lms.admin'))->first();
        $admin_user->assignRole($role_admin);

        $teacher_user = User::where('email', 'teacher@xlms.com')->first();
        $teacher_user->assignRole($role_teacher);

        $student_user = User::where('email', 'trainee@xlms.com')->first();
        $student_user->assignRole($role_student);


        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
