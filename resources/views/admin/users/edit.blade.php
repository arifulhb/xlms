@extends('layouts.app')

@include('parts.app.body.breadcrumb', ['model' => $user])

@section('content')

<div class="row">

   @include('admin.users.form')

</div>

@endsection
