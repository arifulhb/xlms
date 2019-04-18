<?php

namespace App;

use App\Course;
use Nestable\NestableTrait;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use NestableTrait;

    protected $parent = 'parent_id';

    protected $fillable = [
        'name', 'slug', 'description', 'created_by', 'updated_by', 'parent_id'
    ];


    /**
     * Many to Many relation between course and category
     */
    public function courses() {
        return $this->belongsToMany(Course::class, 'course_category_pivot', 'course_category_id', 'course_id');
    }
}
