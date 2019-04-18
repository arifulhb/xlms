@extends('layouts.app')

@include('parts.app.body.breadcrumb')
@section('content')

<div class="row">

    @include('admin.course.crud.course')

</div>

@endsection
@include('parts.components.tinymce', ['element' => 'textarea#post_introduction, textarea#post_key_takeaway, textarea#post_outline'])
