<?php

namespace App;

use App\User;
use App\CourseCategory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [
        'name', 'brief', 'slug', 'introduction', 'structure', 'hours', 'key_takeaway',
        'thumbnail', 'thumbnail_small', 'thumbnail_large', 'keywords',
        'difficulty_level', 'status', 'language', 'author_id',
        'created_by', 'updated_by'
    ];


    public function author() {

        return $this->belongsTo(User::class, 'author_id', 'id');

    }


    public function createdBy() {

        return $this->belongsTo(User::class, 'created_by', 'id');

    }


    public function updatedBy() {

        return $this->belongsTo(User::class, 'updated_by', 'id');

    }


    public function modules() {

    }


    /**
     * Course > Module > Lessons
     */
    public function lessons() {

    }

    public function categories(){

        return $this->belongsToMany(CourseCategory::class, 'course_category_pivot', 'course_id', 'course_category_id');


    }

}
