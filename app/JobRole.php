<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRole extends Model
{

    protected $fillable = [
        'name', 'description', 'created_by', 'updated_by'
    ];


    public function peoples() {

        return $this->belongsToMany(User::class, 'user_jobrole_pivot', 'job_role_id', 'user_id');

    }
}
