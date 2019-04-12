<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
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

        $departments = Department::orderBy('name')
            ->paginate(10);

        $return['title'] = 'Departments';
        $return['departments'] = $departments;
        $return['breadcrumb'] = 'departments';

        return view('admin.department.index', $return);
    }

    public function add(){

        $return['title'] = 'Add new Uepartment';
        $return['breadcrumb'] = 'departments_new';

        return view('admin.department.insert', $return);

    }

    public function insert(Request $request){

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:100|unique:departments,name',
            'description' => 'max:256,',
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->messages());
            return redirect()->route('dept.new')->withInput();
        }

        $post = $request->all();

        $dept = new Department();
        $dept->name         = $post['name'];
        if(isset($post['description'])){
           $dept->description        = $post['description'];
        }
        $dept->created_by   = Auth::user()->id;
        $dept->updated_by   = Auth::user()->id;
        $dept->save();

        Session::flash('message', 'dept created!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('dept.edit', ['id'=> $dept->id]);

    }

    public function update(Request $request, int $id){

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:100|unique:departments,name,'.$id,
            'description' => 'sometimes|string|max:256,',
        ]);

        if ($validator->fails()) {
             Session::flash('errors', $validator->messages());
             return redirect()->back()->withInput();
        }

        $post = $request->all();

        $dept = Department::find($id);

        $dept->name = $post['name'];
        if(isset($post['description'])){
            $dept->description        = $post['description'];
         }
        $dept->updated_by= Auth::user()->id;
        $dept->save();

        Session::flash('message', 'Department updated!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('dept.edit', ['id'=> $id]);

    }

    public function show($id){


        $dept = Department::find($id);

        $return['title'] = 'Edit: '.$dept->name;
        $return['department'] = $dept;
        $return['breadcrumb'] = 'departments_edit';


        return view('admin.department.edit', $return);
    }

    /**
     * @param int $id
     */
    public function delete($id){

        $dept = Department::find($id);
        $dept->delete();

        return response()->json(['message'=>'deleted'])->setStatusCode(204);
    }

    public function search(Request $request){


    }
}
