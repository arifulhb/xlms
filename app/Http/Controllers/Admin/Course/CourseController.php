<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Course;
use App\CourseCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $courses = Course::orderBy('name', 'asc')
            ->paginate(12);

        $return['title'] = 'Courses';
        $return['breadcrumb'] = 'course';
        $return['courses']  = $courses;

        return view('admin.course.crud.index', $return);
    }

    /**
     *
     */
    public function add(){

        // @todo can add cache in Course category for better performance
        $root = CourseCategory::renderAsArray();
        $authors = User::role(\USER_ROLE_INSTRUCTOR)->get();

        $return['title'] = 'Add new Course';
        $return['categories'] = $root;
        $return['authors'] = $authors;

        $return['breadcrumb'] = 'course_new';

        return view('admin.course.crud.insert', $return);

    }

    /**
     *
     */
    public function insert(Request $request){

        $validator = Validator::make($request->all(), [
            'title'         => 'required|string|max:256',
            'introduction'  => 'required|text',
            'outline'       => 'required|text',
            'tagline'       => 'required|string|max:256',
            'author'        => 'required|exists:users,id',
            'categories'    => 'required',
            'difficulty_level' => 'required',
            'status'        => 'required',
            'duration'      => 'max:100'
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->messages());
            return redirect()->route('course.new')->withInput();
        }

        $post = $request->all();

        $course = new Course();
        $course->name         = $post['title'];
        $course->brief         = $post['tagline'];

        $course->slug         = Str::slug($post['title'], '-');

        if (isset($post['introduction'])) {
           $course->introduction        = $post['introduction'];
        }

        if (isset($post['outline'])) {
            $course->structure        = $post['outline'];
        }

        if (isset($post['keytakeaway'])) {
            $course->key_takeaway        = $post['keytakeaway'];
        }

        $course->difficulty_level = $post['difficulty'];

        $course->status = \COURSE_STATUS_DRAFT;
        $course->language = "English";

        $course->author_id = $post['author'];

        if (isset($post['duration'])) {
           $course->hours = $post['duration'];
        }


        $course->created_by   = Auth::user()->id;
        $course->updated_by   = Auth::user()->id;
        $course->save();

        // save the category here
        if (isset($post['categories'])){
            $course->categories()->attach($post['categories']);
        }


        if (isset($post['thumbnail'])) {
            $course->uploadImage(request()->file('thumbnail'), 'thumbnail');
            $course->uploadImage(request()->file('thumbnail'), 'thumbnail_small');
            $course->uploadImage(request()->file('thumbnail'), 'thumbnail_large');
        }

        Session::flash('message', 'Course created!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('course.edit', ['id'=> $course->id]);

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

        $course     = Course::find($id);

        $root       = CourseCategory::renderAsArray();
        $authors    = User::role(\USER_ROLE_INSTRUCTOR)->get();

        $return['title']        = 'Edit: '.$course->title;
        $return['categories']   = $root;
        $return['authors']      = $authors;
        $return['course']       = $course;
        $return['breadcrumb']   = 'course_edit';

        return view('admin.course.crud.edit', $return);

    }

    /**
     * @param int $id
     */
    public function delete($id){

        $course_category = CourseCategory::find($id);

        // @todo if course category has child category, dont delete
        if ($course_category->parent_id == null){
            return response()->json(['message'=>'not allowed'])->setStatusCode(403);
        }
        $course_category->delete();

        return response()->json(['message'=>'deleted'])->setStatusCode(204);
    }

    public function search(Request $request){


    }
}
