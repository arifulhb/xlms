<?php

namespace App;

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
     *
     */
    public function courses() {
        // return $this->belongsToMany(User::class, 'user_department_pivot', 'department_id', 'user_id');
    }
}
