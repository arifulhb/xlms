<?php

namespace App\Import;

use App\User;
use App\JobRole;
use Carbon\Carbon;
use App\Department;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Auth\Passwords\PasswordBroker;
use App\Notifications\NewUserCreatedNotification;

class UserImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {

        if ($row[0] !== 'batch_id'){
            /**
             * Prepre the data here and add
             *
             */

            $user_find = User::where('username', $row[0])
            ->orWhere('email', $row[1])
            ->first();

            if ($user_find == null){

                $newUser = new User([
                    'username'       => $row[0],         //batch_id
                    'name'           => $row[1],         // name
                    'email'          => $row[2],         // email
                    'status'         => \USER_STATUS_PENDING,
                    'password'       => \bcrypt(Str::random(10))
                ]);

                $newUser->save();


                // add role
                $role = 'none';

                if (ucfirst($row[3]) == \USER_ROLE_ADMIN ){
                    $role = USER_ROLE_ADMIN;
                } elseif (ucfirst($row[3]) == \USER_ROLE_INSTRUCTOR ){
                    $role = USER_ROLE_ADMIN;
                } elseif (ucfirst($row[3]) == \USER_ROLE_STUDENT ){
                    $role = USER_ROLE_STUDENT;
                }

                if ($role !== 'none'){
                    $newUser->assignRole($role);
                }


                // add department
                $department = Department::where('name', $row[4])->first();

                if ($department == null){
                    $department = Department::create(['name' => $row[4], 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(), 'created_at'=> Carbon::now()]);
                    $department->save();
                }
                $newUser->departments()->sync([$department->id]);


                // add jobrole
                $job_role = JobRole::where('name', $row[5])->first();

                if ($job_role == null){
                    $job_role = JobRole::create(['name' => $row[5], 'created_by' => Auth::user()->id,  'updated_by' => Auth::user()->id,
                        'updated_at' => Carbon::now(), 'created_at'=> Carbon::now()]);
                    $job_role->save();
                }

                $newUser->jobroles()->sync([$job_role->id]);

                $token = app(PasswordBroker::class)->createToken($user);
                $newUser->notify(new NewUserCreatedNotification($token, $newUser));


                return $newUser;

            } else {

                return $user_find;
            }

        }
    }
}
