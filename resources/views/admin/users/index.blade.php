@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
        <div class="card-header d-flex align-items-center">
            <div class="flex">
                <h4 class="card-title">Browse users</h4>
                {{-- <p class="card-subtitle">Filter</p> --}}
            </div>
            <form action="{{ route('users.all') }}" method="GET" class="form-horizontal">
                    <!-- Actual search box -->
                <div class="input-group pr-3">
                    <input class="form-control py-2 border-right-0 border" placeholder="Search user"
                    type="search" value="{{ \Request::get('q') }}" name="q">
                    <span class="input-group-append">
                        <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>

                </form>
                <a href="{{ route('users.new') }}" class="btn btn-sm btn-primary">
                    <i class="material-icons">person_add</i>&nbsp;Add New
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkall" /></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-right">Last Login</th>
                                <th class="text-right">Updated at</th>
                                <th class="text-right">Action</th>
                            </tr>
                            <tr>
                                <form method="GET" action="{{ route('users.all') }}">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    <select name="role" class="form-control">
                                        <option disabled selected>Select a role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ \Request::get('role') == $role->name ? 'selected' : '' }}
                                                > {{ $role->name}} </option>
                                        @endforeach
                                        <option  value="">None</option>
                                    </select>
                                </th>
                                <th>
                                    <select name="status" class="form-control">
                                        <option disabled selected>Select a status</option>
                                        @foreach(USER_STATUS as $key => $status)
                                            <option value="{{ $key }}"
                                                {{ \Request::get('status') !== null &&  \Request::get('status') == $key ? 'selected' : '' }}>{{ $status }} </option>
                                        @endforeach
                                        <option  value="">None</option>
                                    </select>
                                </th>
                                <th colspan="3" class="text-right">
                                    <button class="btn btn-sm btn-success" type="submit">
                                        <i class="material-icons">filter_list</i>&nbsp;Filter</button>
                                </th>
                                </form>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr id="row_{{ $user->id }}">
                                    <td class="text-left">
                                        <label>
                                            <input type="checkbox" class="checkthis" />
                                            <small class="text-mutted text-small ml-2">{{ $user->id }}</small>
                                        </label>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                        <span class="badge badge-info">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $user->statusText }}</td>
                                    <td class="text-right">
                                        <span class="text-mutted" data-toggle="tooltip" data-placement="top" title="{{ $user->last_login }}">
                                        {{ isset ($user->last_login) ? $user->last_login->diffForHumans() : ''}}</span>
                                    </td>
                                    <td class="text-right"><small>
                                        <span class="text-mutted" data-toggle="tooltip" data-placement="top" title="{{ $user->updated_at }}">
                                            {{  $user->updated_at->diffForHumans() }}</span></small>
                                    </td>
                                    <td class="text-right">

                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-primary dropdown-toggle" id="dropdownMenuLink"
                                                data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                                                aria-expanded="false">Action
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" data-title="Edit" href="{{ route('users.edit', ['id' => $user->id]) }}">Edit</a>
                                                <a class="dropdown-item btn-reset-password" data-title="Reset Password" data-email="{{ $user->email}}" href="javascript:void(0)"
                                                    data-href="{{ route('users.edit', ['id' => $user->id]) }}">Reset password</a>
                                                <div class="dropdown-divider"></div>
                                                <button class="dropdown-item btn-delete-user"
                                                    data-title="Delete" data-toggle="modal"
                                                    data-target="#user_delete_modal" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                                    {{-- <span class="material-icons">remove_circle_outline</span> Delete --}}
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
@include('admin.users.delete_modal')
@endpush
