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
                                        <th width="20" class="text-left">Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th class="text-right">Last Login</th>
                                        <th class="text-right">Updated at</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)

                                    <tr>
                                            <td><input type="checkbox" class="checkthis" /></td>
                                            <td  class="text-left"><small class="text-mutted text-small">{{ $user->id }}</small></td>
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

                                                <div class="btn-group btn-group-sm" role="group" aria-label="">
                                                    <a class="btn btn-primary btn-xs" data-title="Edit"
                                                        href="{{ route('users.edit', ['id' => $user->id]) }}">
                                                        <span class="material-icons">create</span>
                                                    </a>
                                                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                                        <span class="material-icons">remove_circle_outline</span>
                                                    </button>
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
