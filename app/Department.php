<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    // public static $table = "departments";

    protected $fillable = [
        'name', 'description', 'created_by', 'updated_by'
    ];


    public function peoples() {

        return $this->belongsToMany(User::class, 'user_department_pivot', 'department_id', 'user_id');

    }


}
