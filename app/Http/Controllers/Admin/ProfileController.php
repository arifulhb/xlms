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

class ProfileController extends Controller
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

        $return['title'] = 'My Profile';
        $return['user'] = Auth::user();
        $return['roles'] = Role::all();
        $return['breadcrumb'] = 'profile';
        $return['job_roles'] = JobRole::orderBy('name', 'asc')->get();
        $return['departments'] = Department::orderBy('name', 'asc')->get();

        return view('admin.profile.index', $return);
    }

    /**
     * UPDAT USER PROFILE
     */
    public function update(Request $request){

        $post = $request->all();
        $user = Auth::user();

        $validator = Validator::make($post, [
            'email'     => 'required|email|max:100|unique:users,email,'.$user->id,
            'name'      => 'required|string|max:100',
            'username'  => 'required|string|max:100|unique:users,username,'.$user->id,
        ]);

        if ($validator->fails()) {
             Session::flash('errors', $validator->messages());
             return redirect()->back()->withInput();
        }


        $role_permission = $user->roles->toArray()[0]['name'];

        $user->name = $post['name'];
        $user->email = $post['email'];
        $user->username = $post['username'];

        if($role_permission == \USER_ROLE_INSTRUCTOR){
            $user->expertise     = $post['expertise'];
        }
        $user->save();


        if($role_permission == \USER_ROLE_ADMIN || $role_permission == \USER_ROLE_STUDENT){
            $user->departments()->syncWithoutDetaching([$post['department']]);
            $user->jobroles()->syncWithoutDetaching([$post['job_role']]);
        }


        Session::flash('message', 'Profile updated!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('profile.show');

    }

    public function changePassword(Request $request){

        $post = $request->all();
        $user = Auth::user();

        $validator = Validator::make($post, [
            'password'  => 'required|max:50|min:3|confirmed',
        ]);

        if ($validator->fails()) {
             Session::flash('errors', $validator->messages());
             Session::flash('tab', 'changepassword');
             return redirect()->back()->withInput()->with('tab', 'changepassword');
        }


        $role_permission = $user->roles->toArray()[0]['name'];

        $user->password = \bcrypt($post['password']);
        $user->save();

        Session::flash('message', 'Password updated!');
        Session::flash('tab', 'changepassword');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('profile.show');


    }

    /**
     * @param int $id
     */
    public function delete($id){

        $user = User::find($id);
        $user->delete();

        return response()->json(['message'=>'deleted'])->setStatusCode(204);
    }

}
