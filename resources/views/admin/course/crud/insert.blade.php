@extends('layouts.app')

@include('parts.app.body.breadcrumb')
@section('content')

<div class="row">


    {{-- @include('admin.course.category.form') --}}
    @include('admin.course.crud.course')


</div>

@endsection
