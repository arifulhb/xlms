@extends('layouts.app')

@section('content')

<div class="row">

    {{-- <div class="col-lg-8 col-md-8 col-sm-12">

            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            here
    </div> --}}

    @include('admin.users.form')

</div>

@endsection
