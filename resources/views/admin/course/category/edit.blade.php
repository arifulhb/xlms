@extends('layouts.app')

@include('parts.app.body.breadcrumb', ['model' => $course_category])

@section('content')

<div class="row">

    @include('admin.course.category.form')

</div>

@endsection
