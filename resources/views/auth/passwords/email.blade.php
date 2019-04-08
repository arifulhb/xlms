@extends('guest.layouts.app')

@section('content')


<div class="card-header text-center">
    <h4 class="card-title">Forgot Password?</h4>
    <p class="card-subtitle">Recover your account password</p>
</div>
<div class="card-body">

    {{-- @todo show success message  --}}
    {{-- <div class="alert alert-light border-1 border-left-3 border-left-primary d-flex" role="alert">
        <i class="material-icons text-success mr-3">check_circle</i>
        <div class="text-body">An email with password reset instructions has been sent to your email address, if it exists on our system.</div>
    </div> --}}

    <form action="{{ url('/password/email')}} " novalidate="" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label class="form-label" for="email">Email address:</label>
            <div class="input-group input-group-merge">
                <input id="email" type="email" name="email" required="" class="form-control form-control-prepended" placeholder="Your email address">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Send instructions</button>
    </form>
</div>
<div class="card-footer text-center text-black-50">Remember your password? <a href="{{ url('login') }}">Login</a></div>


@endsection
