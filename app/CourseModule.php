<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{

    protected $fillable = [
        'title', 'description', 'position', 'course_id',
    ];


    /**
     *
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     *
     */
    public function lessons() {


    }

}
