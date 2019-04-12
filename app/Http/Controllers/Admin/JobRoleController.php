<?php

namespace App\Http\Controllers\Admin;

use App\JobRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class JobRoleController extends Controller
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

        $jobRoles = JobRole::orderBy('name')
        ->paginate(10);

        $return['title'] = 'Job Roles';
        $return['job_roles'] = $jobRoles;
        $return['breadcrumb'] = 'jobroles';

        return view('admin.jobrole.index', $return);

    }

    public function add(){

        $return['title'] = 'Add new Job Role';
        $return['breadcrumb'] = 'jobroles_new';

        return view('admin.jobrole.insert', $return);

    }

    public function insert(Request $request){

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:100|unique:job_roles,name',
            'description' => 'max:256,',
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->messages());
            return redirect()->route('jobrole.new')->withInput();
        }

        $post = $request->all();

        $jr = new JobRole();
        $jr->name         = $post['name'];
        if(isset($post['description'])){
           $jr->description        = $post['description'];
        }
        $jr->created_by   = Auth::user()->id;
        $jr->updated_by   = Auth::user()->id;
        $jr->save();

        Session::flash('message', 'Job Role created!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('jobrole.edit', ['id'=> $jr->id]);


    }

    public function update(Request $request, int $id){

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:100|unique:job_roles,name,'.$id,
            'description' => 'sometimes|string|max:256,',
        ]);

        if ($validator->fails()) {
             Session::flash('errors', $validator->messages());
             return redirect()->back()->withInput();
        }

        $post = $request->all();

        $dept = JobRole::find($id);

        $dept->name = $post['name'];
        if(isset($post['description'])){
            $dept->description        = $post['description'];
         }
        $dept->updated_by= Auth::user()->id;
        $dept->save();

        Session::flash('message', 'Job Role updated!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('jobrole.edit', ['id'=> $id]);

    }

    public function show($id){

        $jr = JobRole::find($id);

        $return['title'] = 'Edit: '.$jr->name;
        $return['breadcrumb'] = 'jobroles_edit';
        $return['job_role'] = $jr;


        return view('admin.jobrole.edit', $return);

    }

    public function delete($id){

        $dept = JobRole::find($id);
        $dept->delete();

        return response()->json(['message'=>'deleted'])->setStatusCode(204);

    }

    public function search(Request $request){


    }
}
