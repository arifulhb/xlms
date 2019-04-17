<?php

//Admin
Breadcrumbs::for('admin', function ($trail) {
    $trail->push('Admin', route('dashboard'));
});
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Admin', route('dashboard'));
});


// Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users.all'));
});

Breadcrumbs::for('users_show', function ($trail, $model) {
    $trail->parent('users');
    $trail->push('Edit User: '.$model->name, route('users.edit', ['id' => $model->id]));
});


Breadcrumbs::for('users_new', function ($trail) {
    $trail->parent('users');
    $trail->push('Add New User', route('users.new'));
});

// Profile
Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', route('profile.show'));
});


/**
 * Departments
 */
Breadcrumbs::for('departments', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Departments', route('dept.all'));
});

Breadcrumbs::for('departments_new', function ($trail) {
    $trail->parent('departments');
    $trail->push('Add New', route('dept.new'));
});

Breadcrumbs::for('departments_edit', function ($trail, $model) {
    $trail->parent('departments');
    $trail->push('Edit Department: '.$model->name, route('dept.edit', ['id' => $model->id]));
});



/**
 * Job Roles
 */
Breadcrumbs::for('jobroles', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Job Roles', route('jobrole.all'));
});

Breadcrumbs::for('jobroles_new', function ($trail) {
    $trail->parent('jobroles');
    $trail->push('Add New', route('jobrole.new'));
});

Breadcrumbs::for('jobroles_edit', function ($trail, $model) {
    $trail->parent('jobroles');
    $trail->push('Edit Job Role: '.$model->name, route('jobrole.edit', ['id' => $model->id]));
});

/**
 * course_category
 */

Breadcrumbs::for('course_category', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Coures category', route('course_category.all'));
});


Breadcrumbs::for('course_category_new', function ($trail) {
    $trail->parent('course_category');
    $trail->push('Add New', route('course_category.new'));
});

Breadcrumbs::for('course_category_edit', function ($trail, $model) {
    $trail->parent('course_category');
    $trail->push('Edit Course Category: '.$model->name, route('course_category.edit', ['id' => $model->id]));
});
