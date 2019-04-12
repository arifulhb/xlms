@extends('layouts.app')

@include('parts.app.body.breadcrumb', ['model' => $department])

@section('content')

<div class="row">

    @include('admin.department.form')

</div>

@endsection
