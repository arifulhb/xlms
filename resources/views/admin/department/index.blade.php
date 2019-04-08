@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
        <div class="card-header d-flex align-items-center">
            <div class="flex">
                <h4 class="card-title">Browse Departments</h4>
            </div>
                {{-- <form action="{{ route('dept.all') }}" method="GET" class="form-horizontal">
                    <!-- Actual search box -->
                    <div class="input-group pr-3">
                        <input class="form-control py-2 border-right-0 border" placeholder="Search departments"
                        type="search" value="{{ \Request::get('q') }}" name="q">
                        <span class="input-group-append">
                            <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form> --}}
                <a href="{{ route('dept.new') }}" class="btn btn-sm btn-primary">
                    <i class="material-icons">add</i>&nbsp;Add New
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkall" /></th>
                                <th>Name</th>
                                <th>Peoples Count</th>
                                <th class="text-right">Updated at</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $dept)
                                <tr id="row_{{ $dept->id }}">
                                    <td class="text-left">
                                        <label>
                                            <input type="checkbox" class="checkthis" />
                                            <small class="text-mutted text-small ml-2">{{ $dept->id }}</small>
                                        </label>
                                    </td>
                                    <td>{{ $dept->name }}</td>
                                    <td>{{ '' }}</td>
                                    <td class="text-right"><small>
                                        <span class="text-mutted" data-toggle="tooltip" data-placement="top" title="{{ $dept->updated_at }}">
                                            {{  $dept->updated_at->diffForHumans() }}</span></small>
                                    </td>
                                    <td class="text-right">

                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-primary dropdown-toggle" id="dropdownMenuLink"
                                                data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                                                aria-expanded="false">Action
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" data-title="Edit" href="{{ route('dept.edit', ['id' => $dept->id]) }}">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <button class="dropdown-item btn-delete-dept"
                                                    data-title="Delete" data-toggle="modal"
                                                    data-target="#dept_delete_modal" data-id="{{ $dept->id }}" data-name="{{ $dept->name }}">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-html')
@include('admin.department.delete_modal')
@endpush
