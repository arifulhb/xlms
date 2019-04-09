<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\JobRole;
use Carbon\Carbon;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Passwords\PasswordBroker;
use App\Notifications\NewUserCreatedNotification;
use App\Notifications\UserIsUnsuspendedNotification;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {


        if ($request->has('role') || $request->has('status') || $request->has('q')){

            $fields = $request->all();

            $users = User::with(['roles'])
                ->orderBy('updated_at', 'desc')
                ->where(function($query) use($fields) {

                if (isset($fields['status'])){
                    $query->where('status', $fields['status']);
                }


                if (isset($fields['role'])) {
                    $query->whereHas('roles', function($q) use($fields){
                        $q->where('name', $fields['role']);
                    });
                }

                if(isset($fields['q'])){
                    $query->where('name', 'like', '%'.$fields['q'].'%')
                    ->orWhere('email', 'like', '%'.$fields['q'].'%');
                }

                return $query;

            })->paginate(10);

        } else {

            $users = User::with(['roles'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        }

        $return['title'] = 'Users';
        $return['users'] = $users;
        $return['roles'] = Role::all();

        return view('admin.users.index', $return);
    }

    public function add(){

        $departments =  Department::orderBy('name')->get();
        $job_roles =  JobRole::orderBy('name')->get();

        $return['title'] = 'Add new User';
        $return['roles'] = Role::all();
        $return['departments'] = $departments;
        $return['job_roles'] = $job_roles;

        return view('admin.users.insert', $return);

    }

    public function insert(Request $request){

        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|max:100|unique:users,email',
            'name'      => 'required|string|max:100',
            'username'  => 'required|string|max:100|unique:users,username,',
            'role'      => 'required|string',
            'department'=> 'required_if:role,Admin,Student',
            'job_role'  => 'required_if:role,Admin,Student'
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->messages());
            return redirect()->route('users.new')->withInput();
       }


        $post = $request->all();

        $user = new User();
        $user->name         = $post['name'];
        $user->email        = $post['email'];
        $user->username     = $post['username'];
        $user->status       = \USER_STATUS_PENDING;
        $user->password     = bcrypt('secret');

        if($post['role'] == 'Instructor'){
            $user->expertise     = $post['expertise'];
        }
        $user->save();

        $user->assignRole($post['role']);

        if($post['role'] == 'Admin' || $post['role'] == 'Student'){
            $user->departments()->syncWithoutDetaching([$post['department']]);
            $user->jobroles()->syncWithoutDetaching([$post['job_role']]);
        }


        $token = app(PasswordBroker::class)->createToken($user);
        $user->notify(new NewUserCreatedNotification($token, $user));


        Session::flash('message', 'User created!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('users.edit', ['id'=> $user->id]);

    }

    public function update(Request $request, int $id){

        // @todo validation required
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|max:100|unique:users,email,'.$id,
            'name'      => 'required|string|max:100',
            'username'  => 'required|string|max:100|unique:users,username,'.$id,
        ]);

        if ($validator->fails()) {
             Session::flash('errors', $validator->messages());
             return redirect()->back()->withInput();
        }

        $post = $request->all();
        $user = User::find($id);

        $role_permission = $user->roles->toArray()[0]['name'];

        $user->name = $post['name'];
        $user->email = $post['email'];
        $user->username = $post['username'];
        if($role_permission== 'Instructor'){
            $user->expertise     = $post['expertise'];
        }
        $user->save();


        if($role_permission== 'Admin' || $role_permission == 'Student'){
            $user->departments()->syncWithoutDetaching([$post['department']]);
            $user->jobroles()->syncWithoutDetaching([$post['job_role']]);
        }


        Session::flash('message', 'User updated!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('users.edit', ['id'=> $id]);

    }

    public function show($id){


        $user = User::with(['departments', 'jobroles'])->find($id);
        $departments =  Department::orderBy('name')->get();
        $job_roles =  JobRole::orderBy('name')->get();

        $return['title'] = 'Edit: '.$user->name;
        $return['user'] = $user;
        $return['departments'] = $departments;
        $return['job_roles'] = $job_roles;
        $return['roles'] = Role::all();


        return view('admin.users.edit', $return);
    }

    /**
     * @param int $id
     */
    public function delete($id){

        $user = User::find($id);
        $user->delete();

        return response()->json(['message'=>'deleted'])->setStatusCode(204);
    }

    public function updateField(Request $request, $id){

        // @todo verify if the user has permission to update status

        $post = $request->all();

        $user = User::find($id);

        if($post['field'] == 'role'){

            // remove current roles
            foreach($user->roles as $role){
                $user->removeRole($role->name);
            }

            $user->assignRole($post['role']);
            Session::flash('message', 'User role updated!');

        }
        else if($post['field'] == 'status'){

            $previous_status = $user->status;
            $user->status = $post['status'];
            $user->save();


            if ($previous_status == \USER_STATUS_SUSPENDED){
                // @TODO notifiy user with a password reset link, that will make the user to pending status
                // $user->notify(new UserIsUnsuspendedNotification());
                Notification::send($user, new UserIsUnsuspendedNotification());


                Session::flash('message', 'User status updated and notification email is sent!');

            } elseif($previous_status == USER_STATUS_BLOCKED){
                // @TODO notifiy user that s/he is unblocked now. And Give the new status

            } else {
                Session::flash('message', 'User status updated!');
            }


        }

        Session::flash('alert-class', 'alert-success');

        return redirect()->route('users.edit', ['id'=> $id]);

    }

    /**
     *
     */
    public function filter(Request $request){


        dd($request->all());

    }

    /**
     *
     */
    public function search(Request $request){

        $keyword = $request->input('q');

        dd($keyword);

    }
}
