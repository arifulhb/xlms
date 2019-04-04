@extends('guest.layouts.app')

@section('content')

<div class="card-header text-center">
    <h4 class="card-title">Login</h4>
    <p class="card-subtitle">Access your account</p>
</div>
<div class="card-body">

    <form action="{{ url('login')}}" novalidate method="post">
        {{ csrf_field() }}

        {{-- {{ var_dump($errors)}} --}}
        @foreach($errors->all()  as $key => $error)
        <div class="alert alert-warning" role="alert">
            <i class="material-icons">info</i> {{ $error }}
        </div>
        @endforeach
        <div class="form-group">
            <label class="form-label" for="email">Your email address:</label>
            <div class="input-group input-group-merge">
                <input id="email" type="email" required="" value="{{ old('email') }}" name="email"
                        class="form-control form-control-prepended"
                        placeholder="Your email address">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Your password:</label>
            <div class="input-group input-group-merge">
                <input id="password" type="password" required=""  name="password"
                class="form-control form-control-prepended" placeholder="Your password">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="material-icons">lock</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group ">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </div>
        <div class="text-center">
            <a href="{{ url('password/reset')}}" class="text-black-70" style="text-decoration: underline;">Forgot Password?</a>
        </div>
    </form>
</div>
<div class="card-footer text-center text-black-50">
    Not yet a student? <a href="{{ url('register')}}">Sign Up</a>
</div>

@endsection
