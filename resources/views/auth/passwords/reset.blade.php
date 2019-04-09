@extends('guest.layouts.app')

@section('content')

<div class="card-header text-center">
        @php
            $title = "Reset Password";
            $subTitle = "Reset your account password";
            if(Request::input('new') !== ''){
                $title = "Set Password";
                $subTitle = "Set your account password";
                $email = Request::input('new');
            }
        @endphp
        <h4 class="card-title">{{ $title }}</h4>
        <p class="card-subtitle">{{ $subTitle }}</p>
    </div>
    <div class="card-body">

        {{-- @todo show success message  --}}
        {{-- <div class="alert alert-light border-1 border-left-3 border-left-primary d-flex" role="alert">
            <i class="material-icons text-success mr-3">check_circle</i>
            <div class="text-body">An email with password reset instructions has been sent to your email address, if it exists on our system.</div>
        </div> --}}

        <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        value="{{ $email ?? old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ $title }}
                        </button>
                    </div>
                </div>
            </form>
    </div>
    <div class="card-footer text-center text-black-50">Remember your password? <a href="{{ url('login') }}">Login</a></div>

@endsection
