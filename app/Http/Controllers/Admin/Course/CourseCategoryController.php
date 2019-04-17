<?php

namespace App\Http\Controllers\Admin;

use App\CourseCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CourseCategoryController extends Controller
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

        $course_category = CourseCategory::orderBy('name', 'asc')
            ->paginate(20);

        $return['title'] = 'Course Categories';
        $return['course_categories'] = $course_category;
        $return['tree'] = CourseCategory::customUrl(url("admin/course-categories/"))->renderAsHtml();
        $return['breadcrumb'] = 'course_category_new';

        return view('admin.course.category.index', $return);
    }

    public function add(){

        $root = CourseCategory::where('parent_id', null)->get();


        $return['title'] = 'Add new Course Ctegory';
        $return['root_categories'] = $root;
        $return['breadcrumb'] = 'course_category_new';

        return view('admin.course.category.insert', $return);

    }

    public function insert(Request $request){

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:100|unique:course_categories,name',
            'slug'      => 'required|string|max:100|unique:course_categories,slug',
            'description' => 'max:256,',
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->messages());
            return redirect()->route('course_category.new')->withInput();
        }

        $post = $request->all();

        $course_category = new CourseCategory();
        $course_category->name         = $post['name'];
        $course_category->slug         = Str::slug($post['slug'], '-');
        if(isset($post['description'])){
           $course_category->description        = $post['description'];
        }

        if (is_numeric($post['parent_id'])) {
            $course_category->parent_id        = $post['parent_id'];
        } else {
            $course_category->parent_id = null;
        }

        $course_category->created_by   = Auth::user()->id;
        $course_category->updated_by   = Auth::user()->id;
        $course_category->save();

        Session::flash('message', 'Course Category created!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('course_category.edit', ['id'=> $course_category->id]);

    }

    /**
     *
     */
    public function update(Request $request, int $id){

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:100|unique:course_categories,name,'.$id,
            'slug'      => 'required|string|max:100|unique:course_categories,slug,'.$id,
            'description' => 'sometimes|string|max:256,',
        ]);

        if ($validator->fails()) {
             Session::flash('errors', $validator->messages());
             return redirect()->back()->withInput();
        }

        $post = $request->all();

        $course_category = CourseCategory::find($id);
        $course_category->name = $post['name'];
        $course_category->slug        = Str::slug($post['slug'], '-');

        if(isset($post['description'])){
            $course_category->description = $post['description'];
         }


        if(isset($post['parent_id'])){
            $course_category->parent_id        = $post['parent_id'];
        } else {
            $course_category->parent_id = null;
        }

        $course_category->updated_by= Auth::user()->id;
        $course_category->save();

        Session::flash('message', 'Coures Category updated!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('course_category.edit', ['id'=> $id]);

    }

    /**
     *
     */
    public function show($id){

        $course_category = CourseCategory::find($id);
        $root = CourseCategory::where('parent_id', null)->get();

        $return['title'] = 'Edit: '.$course_category->name;
        $return['root_categories'] = $root;
        $return['course_category'] = $course_category;
        $return['breadcrumb'] = 'course_category_edit';


        return view('admin.course.category.edit', $return);
    }

    /**
     * @param int $id
     */
    public function delete($id){

        $course_category = CourseCategory::find($id);
        $course_category->delete();

        return response()->json(['message'=>'deleted'])->setStatusCode(204);
    }

    public function search(Request $request){


    }
}
