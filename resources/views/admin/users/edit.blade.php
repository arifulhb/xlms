@extends('layouts.app')

@section('content')

<div class="row">

   @include('admin.users.form')
    {{-- <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card">
                <div class="card-header d-flex align-items-center">
                    <div class="flex">
                        <h5 class="card-title">Operation</h5>
                    </div>
                </div>
            <div class="card-body">

                Block/Suspend/Unsuspend
            </div>
        </div>
    </div> --}}
</div>

@endsection
