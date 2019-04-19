<?php

namespace App;

use App\User;
use App\CourseCategory;
use QCod\ImageUp\HasImageUploads;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasImageUploads;


    // assuming `users` table has 'cover', 'avatar' columns
    // mark all the columns as image fields
    protected static $imageFields = [
        'thumbnail' => [
            // set true to crop image with the given width/height and you can also pass arr [x,y] coordinate for crop.
            'crop' => false,

            // what disk you want to upload, default config('imageup.upload_disk')
            'disk' => 'public',

            // a folder path on the above disk, default config('imageup.upload_directory')
            'path' => 'course',

            // override global auto upload setting coming from config('imageup.auto_upload_images')
            'auto_upload' => false,

            // if request file is don't have same name, default will be the field name
            'file_input' => 'thumbnail',
        ],
        'thumbnail_small' => [
            // width to resize image after upload
            'width' => 200,

            // height to resize image after upload
            'height' => 100,

            // set true to crop image with the given width/height and you can also pass arr [x,y] coordinate for crop.
            'crop' => true,

            // what disk you want to upload, default config('imageup.upload_disk')
            'disk' => 'public',

            // a folder path on the above disk, default config('imageup.upload_directory')
            'path' => 'course',

            // placeholder image if image field is empty
            // 'placeholder' => '/images/avatar-placeholder.svg',

            // validation rules when uploading image
            // 'rules' => 'image|max:2000',

            // override global auto upload setting coming from config('imageup.auto_upload_images')
            'auto_upload' => false,

            // if request file is don't have same name, default will be the field name
            'file_input' => 'thumbnail',
        ],
        'thumbnail_large' => [
            'width' => 800,

            // height to resize image after upload
            'height' => 600,

            // set true to crop image with the given width/height and you can also pass arr [x,y] coordinate for crop.
            'crop' => true,

            // what disk you want to upload, default config('imageup.upload_disk')
            'disk' => 'public',

            // a folder path on the above disk, default config('imageup.upload_directory')
            'path' => 'course',

            // placeholder image if image field is empty
            // 'placeholder' => '/images/avatar-placeholder.svg',

            // validation rules when uploading image
            // 'rules' => 'image|max:2000',

            // override global auto upload setting coming from config('imageup.auto_upload_images')
            'auto_upload' => false,

            // if request file is don't have same name, default will be the field name
            'file_input' => 'thumbnail',
        ]
    ];

    // override cover file name
    protected function thumbnailSmallUploadFilePath($file) {

        return $this->id.'/'.$this->id . '-thumbnail_small.jpg';

    }

    protected function thumbnailLargeUploadFilePath($file) {

        return $this->id.'/'.$this->id . '-thumbnail_large.jpg';
    }

    protected function thumbnailUploadFilePath($file) {

        return $this->id.'/'.$this->id . '-thumbnail.jpg';

    }

    protected $fillable = [
        'name', 'brief', 'introduction', 'structure', 'hours', 'key_takeaway',
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
