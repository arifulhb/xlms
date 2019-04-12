@extends('layouts.app')

@include('parts.app.body.breadcrumb', ['model' => $job_role])
@section('content')

<div class="row">

    @include('admin.jobrole.form')

</div>

@endsection
