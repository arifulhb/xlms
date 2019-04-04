<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';


    /**
     * Admin Namespace
     */
    protected $namespaceAdmin = 'App\Http\Controllers\Admin';



    /**
     * Instructor Namespace
     */
    protected $namespaceInstructor = 'App\Http\Controllers\Instructor';



    /**
     * Student Namespace
     */
    protected $namespaceStudent = 'App\Http\Controllers\Student';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapInstructorRoutes();


        $this->mapStudentRoutes();

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }


    /**
     * Admin Routes
     */
    protected function mapAdminRoutes(){

        Route::prefix('admin')
        ->namespace($this->namespaceAdmin)
        ->group(base_path('routes/admin.php'));

    }


    /**
     * Instructor Routes
     */
    protected function mapInstructorRoutes(){

        Route::prefix('instructor')
        ->namespace($this->namespaceInstructor)
        ->group(base_path('routes/instructor.php'));

    }


    /**
     * Student Routes
     */
    protected function mapStudentRoutes(){

        Route::prefix('student')
        ->namespace($this->namespaceStudent)
        ->group(base_path('routes/student.php'));

    }

}
