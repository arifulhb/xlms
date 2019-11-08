@extends('layouts.app')

@include('parts.app.body.breadcrumb')

@section('content')

<div class="row">

    <div class="col-lg-7 col-md-7 col-sm-12">
        <div class="card">
        <div class="card-header d-flex align-items-center">
            <div class="flex">
                <h4 class="card-title">Browse {{ $title }}</h4>
            </div>
                <form action="{{ route('dept.all') }}" method="GET" class="form-horizontal">
                    <!-- Actual search box -->
                    <div class="input-group pr-3">
                        <input class="form-control py-2 border-right-0 border" placeholder="Search Courses"
                        type="search" value="{{ \Request::get('q') }}" name="q">
                        <span class="input-group-append">
                            <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <a href="{{ route('course.new') }}" class="btn btn-sm btn-primary">
                    <i class="material-icons">add</i>&nbsp;Add New
                </a>
            </div>
            <div class="card-body">
                body
            </div>
            <div class="card-footer">
                {{ $courses->links() }}
            </div>
        </div>
    </div>


</div>
@endsection

{{-- @push('footer-html')
@include('admin.course.category.delete_modal')
@endpush --}}
