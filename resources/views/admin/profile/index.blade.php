@extends('layouts.app')

@include('parts.app.body.breadcrumb')

@section('content')

<div class="row">

    <div class="col-lg-8 col-md-8 col-sm-12">

            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
            @endif

            <div class="card">
                <ul class="nav nav-tabs nav-tabs-card">
                    <li class="nav-item">
                        <a class="nav-link {{ Session::has('tab') ? '' : 'active'}}" href="#first" data-toggle="tab">My Profile</a>
                        <a class="nav-link {{ Session::has('tab') ? 'active' : ''}}" href="#change-password" data-toggle="tab">Change Password</a>
                    </li>
                </ul>
                <div class="tab-content card-body">
                    @include('admin.profile.profile')
                    @include('admin.profile.change_password')
                </div>
            </div>
        </div>


</div>

@endsection
