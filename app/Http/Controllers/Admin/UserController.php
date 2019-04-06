<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
    public function index()
    {

        $users = User::orderBy('updated_at', 'desc')
            ->paginate(10);

        $return['title'] = 'Users';
        $return['users'] = $users;

        return view('admin.users.index', $return);
    }

    public function add(){

        $return['title'] = 'Add new User';
        $return['roles'] = Role::all();

        return view('admin.users.insert', $return);

    }

    public function insert(Request $request){

        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|max:100|unique:users,email',
            'name'      => 'required|string|max:100',
            'username'  => 'required|string|max:100|unique:users,username,',
            'role'      => 'required|string'
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
        $user->save();

        $user->assignRole($post['role']);

        // @todo send confirmation email to user with password change link

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

        $user->name = $post['name'];
        $user->email = $post['email'];
        $user->username = $post['username'];
        $user->save();

        Session::flash('message', 'User updated!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('users.edit', ['id'=> $id]);

    }

    public function show($id){


        $user = User::find($id);

        $return['title'] = 'Edit: '.$user->name;
        $return['user'] = $user;
        $return['roles'] = Role::all();


        return view('admin.users.edit', $return);
    }

    public function delete($id){


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

            $user->status = $post['status'];
            $user->save();

            Session::flash('message', 'User status updated!');

        }

        Session::flash('alert-class', 'alert-success');

        return redirect()->route('users.edit', ['id'=> $id]);

    }

    public function search(Request $request){


    }
}
